<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User\ShippingAddress;
use App\Models\Product\ProductDetail;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\Location\City;
use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $cartArray = [];
    private $discount = 0;
    private $currency ='INR';

    public function index(Request $r){
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data['layout']=getLayout();
        $cart = Session::get('PCart');
        if($cart){
            
            if(isset($cart['product'])){
                $this->getProduct($cart['product']);
            }
            
            $data['cart'] = $this->cartArray;
           # $data['cart'] = $cart;
        } else {
            $data['cart'] = '';
        }
        $currentUser = getCurrentUser();
        $data['isUser'] = ( $currentUser['user_type'] && $currentUser['user_id']) ? true : false;
        return view('cart/list',$data);
    }
    public function saveProductCart($products){
        foreach ($products as $key => $value) {
            // dd($value);
            if(isset($value['qty']) && isset($value['item_id']) && $value['pdid']){
                $ct=Cart::updateOrCreate(['user_id'=>Auth::id(),'product_id'=>$value['item_id'],'product_detail_id'=>$value['pdid'],'quantity'=>$value['qty'],'currency'=>'inr'],['status'=>1]);
                if(Session::has('PCart')){
                    $cart=Session::get('PCart');
                    if($cart){
                        if(isset($cart['product'])){
                            if(isset($cart['product'][$key])) {
                                unset($cart['product'][$key]);
                            }
                        }
                    }
                    Session::put('PCart', $cart);
                }
            }
        }
    }
    public function getProduct($products){
        $currentUser = getCurrentUser();
       
        foreach ($products as $key => $value) {
           
            $pd = Product::find($key);
            
            if(isset($value['item_id'])){
                $pdetail=ProductDetail::find($value['item_id']);
            }else{
                $pdetail=$pd->pDetail;
            }
            $tempArr = [
                'id' => $pd->id,
                'name' => $pd->name,
                'currency' => $this->currency,
                'user_type' => 'user',
                'detail'=>$pd,
                'pdetail'=>$pdetail,
                'qty'=>$value['qty'],
            ];
            if($currentUser['user_type'] == '' || $currentUser['user_type'] == 'user'){
                array_push($this->cartArray, $tempArr);
            }
        }
        if(Auth::check()){
            $cpds=Cart::where(['status'=>1,'user_id'=>Auth::id()])->get();
            foreach ($cpds as $value) {
                $pd = Product::find($value->product_id);
                if($value->product_detail_id){
                    $pdetail=ProductDetail::find($value->product_detail_id);
                }else{
                    $pdetail=$pd->pDetail;
                }
                $tempArr = [
                    'id' => $pd->id,
                    'name' => $pd->name,
                    'currency' => $this->currency,
                    'user_type' => 'user',
                    'detail'=>$pd,
                    'pdetail'=>$pdetail,
                    'qty'=>$value['qty'],
                ];
                array_push($this->cartArray, $tempArr);
            }

        }
    }
    public function checkoutPayment(Request $request){
        if(Auth::check()){
          
            $data=$request->all();
            $user=Auth::user();
            $data['layout']=getLayout();
            $data['user']=$user;
            // dd($data);
            return view('cart.checkout-payment',$data);
        }else{
            return redirect('view-cart')->with('warning',NotAuth);
        }
    }

    public function removeFromCart(Request $r){
        if(Session::has('PCart')){
            $cart=Session::get('PCart');
            if($cart){
                if(isset($cart['product'])){
                    if(isset($cart['product'][$r->item_id])) {
                        unset($cart['product'][$r->item_id]);
                    }
                }
            }
            Session::put('PCart', $cart);
        }
        if(Auth::check()){
            $rmcart=Cart::where(['product_id'=>$r->item_id])->update(['status'=>0]);
        }
        return array('status'=>1,'message'=>RemoveCart);
    }

    public function checkOut(Request $r){
        if(Auth::check()){
            $user=Auth::user();
            $data['layout']=getLayout();
            $cart = Session::get('PCart');
           
            if($cart){
                if(isset($cart['product'])){
                    $this->saveProductCart($cart['product']);
                }
            }
            $carts=Cart::where(['user_id'=>$user->id,'status'=>1])->get();
            $data['saddress']=ShippingAddress::where(['user_id'=>$user->id,'status'=>1])->get();
            $data['pcarts']=$carts;
            $data['user']=$user;
            $data['countries']=Country::orderby('name','asc')->get();
            if($carts->count()){
                return view('cart.checkout',$data);
            }else{
                return redirect('view-cart')->with('warning',CartEmpty);
            }
        }else{
            return redirect('view-cart')->with('warning',NotAuth);
        }
    }
    public function addToCart(Request $r){

        $cart = Session::get('PCart');
        $cart['product'][$r->item_id] = [
            'user_type' => 'user',
            'item_id' => $r->item_id,
            'pdid' => $r->pdid,
            'quantity' => 1
        ];
        // if cart is empty
        if(!$cart){
            session()->put('PCart', $cart);
        }
        // if cart not empty then check if this product exist
        if(isset($cart['product'][$r->item_id])) {
            $cart['product'][$r->item_id]['quantity'] = 1;
            $cart['product'][$r->item_id]['pdid'] = $r->pdid;
            session()->put('PCart', $cart);
        } else {
            session()->put('PCart', $cart);
        }
        return $cart;

    }

    public function addToCartJson(Request $r){
        $products = Product::with('pDetail')->findOrFail($r->pdid);
        if($products){
            $cart = Session::get('PCart');
            // if cart is empty
            // if cart not empty then check if this product exist
            if(isset($r->quantity) && $r->quantity){
                $quantity = intval($r->quantity);
            }
            else{
                $quantity = 1;
            }
            if(isset($cart['product'][$r->pdid])) {
               # $cart[$id]['quantity']= $quantity + $cart[$id]['quantity'];
                $cart['product'][$r->pdid]['qty'] =  $cart['product'][$r->pdid]['qty']+$quantity;
                $cart['product'][$r->pdid]['pdid'] = $r->pdid;
                session()->put('PCart', $cart);
                
            } else {
                $cart['product'][$r->pdid] = [
                    'user_type' => 'user',
                    'item_id' => $r->item_id,
                    'pdid' => $r->item_id,
                    "inr_price" => $products->pDetail->inr_price,
                    "usd_price" => $products->pDetail->usd_price,
                    "inr_sell_price" => $products->pDetail->inr_sell_price,
                    "usd_sell_price" => $products->pDetail->usd_sell_price,
                    "pname" => $products->name,
                    "gst" => $products->gst,
                    "image" => $products->image,
                    "thumbnail_url" => $products->thumbnail_url,
                    "url" => $products->url,
                    'qty' => $quantity
                ];
                session()->put('PCart', $cart);
            }
            $data['message'] = AddCart;
            $data['statusCode'] = 200;
            $data['cart'] = $cart;
            $html = view("layouts.common.header-cart", ['cart' => $cart])->render();
            $data["html"] = $html;
            return response()->json($data,200);
        }else{
            $data['message'] = ProductNotFound;
            $data['statusCode'] = 201;
            return response()->json($data,201);
        }

    }

    public function applyCoupon(Request $re){
        $code = trim($re->coupon);
        $cur_date = date('Y-m-d');
        DB::enableQueryLog();
        $apply = Coupon::where('status',DB::raw('"1"'))->where('code',DB::raw('"'.$code.'"'))->where('end_date','>=',DB::raw('"'.$cur_date.'"'))->first();
       
       # prd(DB::getQueryLog());
        if(empty($apply)){
            return response(array('success'=>false,'message'=>'<span style="color:red">Coupon already Expire|</span>'));
        }

        $usercoupon = UserCoupon::where('coupon_id',$apply->id)->where('user_id',Auth::id())->get();
        $coupon_count = $usercoupon->count();

        if($apply->coupon_label == 'new_user' && $coupon_count >= 1 ){
            return response(array('success'=>false,'message'=>'<span style="color:red">Coupon Code alraedy Used?</span>'));
        }

        if($coupon_count >= $apply->coupon_count ){
            return response(array('success'=>false,'message'=>'<span style="color:red">Coupon Code alraedy Used?</span>'));
        }

        if($apply){
            $user =  Auth::user();
            $cartCollection= Cart::where(['user_id'=>$user->id,'status'=>1])->get();
          
            $subtotal = 0;
            $tax = 0;
            $total_amt = 0;
            $price = 0;
            $coupon_discount = 0;
            foreach ($cartCollection as $pd) {
                $pdetail=$pd->pDetail;
                $maxp=$sellp=$gst=0;
                if(isset($pdetail->inr_sell_price) && $pdetail->inr_sell_price){
                    $maxp=$pdetail->inr_price??0;
                    $sellp=$pdetail->inr_sell_price??0;
                }else{
                    $sellp=$pdetail->inr_price??0;
                }
                $sells = $sellp*$pd->quantity;
                $gst=$pd->product->gst??0;
                $price+=$sells;
                $tax=$tax+(($sells*$gst)/100);
                if($price<999){
                    $shipping=150;
                }
            }
            $total_amt = $price;
            $apply_min_val = (int)$apply->stock_value;
            if($apply_min_val > $total_amt){
                return response(array('success'=>false,'message'=>'<span style="color:red">Coupon Code is Application Minium Amount : '.$apply_min_val.'?</span>'));
            }
            
            if($apply->type=='%'){
                $coupon_discount = $total_amt*$apply->per_amt/100;
                $grand_total = $total_amt - $coupon_discount;
                $data['type_coupon']='%';
                $data['coupon_discount']= $coupon_discount;

            }else{
                $coupon_discount = $apply->per_amt;
                $grand_total = $total_amt - $apply->per_amt;
                $data['type_coupon']='fix';
                $data['coupon_discount']= $coupon_discount;
            }
                $data['type_val']=$coupon_discount;
                $data['type']='1';
                $coupon = Session::get('code');
                $coupon = [
                    'type_coupon' => $data['type_coupon'],
                    'coupon_discount' => $data['coupon_discount'],
                    'coupon_name' => $code,
                    
                ];
            session()->put('code', $coupon);
            //Session::put(['code'=>$code,'coupon_discount'=>$coupon_discount,'grand_total'=>$grand_total]);
            return response(array('success'=>true,'status'=>true,'dis'=>$data,'message'=>'<span style="color:green">Coupon is applied</span>'));
        }else{
           // Session::put(['code'=>'' ,'coupon_discount'=>0,'grand_total'=>0]);
            return response(array('success'=>false,'message'=>'<span style="color:red">Coupon is not applicable?</span>'));
        }
    }
    
}
