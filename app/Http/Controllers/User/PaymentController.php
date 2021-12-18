<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User\ShippingAddress;
use File;
use DB;
use Mail;
use URL;
use Validator;
use Session; 
use Razorpay\Api\Api;

class PaymentController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user');
    }
    public function buyProduct(Request $r){
        $validate=Validator::make($r->all(),[
            'product_id'=>'required',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first());
        }
        try {
           Cart::updateOrCreate(['user_id'=>Auth::id(),'product_id'=>$r->product_id,'product_detail_id'=>$r->product_detail_id,'quantity'=>$r->quantity,'currency'=>'inr'],['status'=>1]);
           return redirect('checkout');   
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            dd($msg);
        }
    }

    public function razarpayorder(Request $request, $id =  null){
        // require_once __DIR__.'/Razorpay.php';
        $mergent_id="GkqSg18WRckgOK";
        // $api_key="rzp_live_oiPhSL1G4oh2eC"; // for live
        $api_key="rzp_test_NXO9x1hZTHgE2q"; // for test mode
        // $api_secret="xpufnQnpPEU0aPLwsrrNkEZP"; //for live
        $api_secret="pqaQBUVjBL62W72lRpMXij25"; // for test mode
        $amount=$request->amount;
        $api = new Api($api_key, $api_secret);
        $orderData = [
        'amount' => $amount,
        'currency' => 'INR',
        'payment_capture' => 1
        ];
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        return $razorpayOrderId;
    }


    public function paymentProcess(Request $r) {
        $validate=Validator::make($r->all(),[
            'shipping_address_id'=>'required|integer',
        ]);
        $user=Auth::user();
        $od=new Order();
        $ca['order_id']=$od->order_id='OD'.date('ymdhis').$user->id;
        $ca['shipping_address_id']=$od->shipping_address_id=$r->shipping_address_id;
        $ca['user_id']=$od->user_id=$user->id;
        $od->currency=$r->currency??'inr';
        $od->price=$r->price??0;
        $od->total_price=$r->total_price??0;
        $od->tax=$r->tax??0;
        $od->shipping=$r->shipping??0;
        $od->discount=$r->coupon_code_dis_hid??0;
        $od->discount_name=$r->coupon_code_hid??null;
        $od->payment_id=$r->payment_id??null;
        $od->payment_mode=$r->payment_mode;
        try {
            if($r->product && is_array($r->product)){
                foreach($r->product as $k=>$pd){
                    if($k==0){
                        $od->product_id=$pd['id']??0;
                        $od->quantity=$pd['quantity']??1;
                        $od->p_price=$pd['price']??0;
                        $od->product_detail_id=$pd['product_detail_id']??0;
                        $od->save();
                        $ca['parent_id']=$od->id;
                        Cart::where(['product_detail_id'=>$od->product_detail_id,'product_id'=>$od->product_id,'user_id'=>$user->id])->delete();

                    }else{
                        $ca['product_id']=$pd['id']??0;
                        $ca['quantity']=$pd['quantity']??1;
                        $od->p_price=$pd['price']??0;
                        $ca['product_detail_id']=$pd['product_detail_id']??0;
                        Order::insert($ca);
                        Cart::where(['product_detail_id'=>$ca['product_detail_id'],'product_id'=>$ca['product_id'],'user_id'=>$user->id])->delete();
                    }
                }
            }

            $single=Order::where(['user_id'=>$user->id,'order_id'=>$ca['order_id']])->first();
            $lists=Order::where(['user_id'=>$user->id,'order_id'=>$ca['order_id']])->get();

            $saddress=ShippingAddress::find($single->shipping_address_id);
           
            $baddress=ShippingAddress::where(['user_id'=>$user->id,'status'=>1,'add_type'=>'billing'])->first();
            if(!$baddress){
                $baddress=$saddress;
            }
            $emalto = $user->email;
            $data['single'] = $single;
            $data['lists'] = $lists;
            $data['saddress'] = $saddress;
            $data['baddress'] = $baddress;
            Mail::send('emails.order-pdf',$data, function ($message) use ($emalto) {
            $message->from('account@abeerjaipur.com', 'Abeer Business');
            $message->to($emalto)
               //->cc('abeerjaipur1@gmail.com')
               ->subject('Order Confirm');
        });
            $path = storage_path('app/pdf/orders');
            $filename = "order_{$od->order_id}";
            # $pdf = PDF::loadView('order-pdf',  ['orders'=>$orders,'title'=>'test','active'=>'test']);
            $pdf = PDF::loadView('emails.order-pdf',  ['single'=>$single,'lists'=>$lists,'saddress'=> $saddress,'baddress'=> $baddress])->save(''.$path.'/'.$filename.'.pdf');

        } catch (\Exception $e) {
            $msg=$e->getMessage(); 
            dd($msg); 
        }
        // $data=array('userdata' => $userdata, 'url'=>$url,'product_data'=>$product_data,'order_data'=>$order_data);
        
      
     return redirect('user/order-confirm/'.$od->id)->with('success','Placed');

    }
  
public function cancel_order(Request $r){
  // $field=Order->where('id',$r->cancel_reason_hid)->first(); 
  // $field->order_status="canceled"; 
  // $field->cancellation_reason=$r->cancel_reason;
  $status=Order::where('id',$r->cancel_id)->where('order_id',$r->cancel_reason_hid)->update(['order_status'=>$r->order_status,'cancellation_reason'=>$r->cancel_reason]);
  if($status){

    return redirect()->back()->with('success', 'We will contact you soon');   ;
  }

}  
public function buy_now(Request $r){
  
  $p_data=Productmaster::where('id',$r->product_id)->first();

  $field['user_id'] = Auth::id();
  $field['product_id'] = $p_data->id;
  $field['product_name'] =$p_data->product_name;
  $field['quantity'] = $r->quantity; 
  $field['mrp'] = $p_data->mrp;
  $field['saleprice'] = $p_data->sale_price;
  $field['real_price'] = $p_data->real_price;
  $field['gst'] = $p_data->gst;
  $field['color'] = $p_data->color;
  $field['size'] = $r->size;
  $field['images'] = $p_data->front_image;
  // dd($p_data);
  $status = Cart::create($field);
  if($status){
    return redirect('checkout');
  }
}
public function order_confirm($id){
  $order_data=Order::where('id',$id)->first();
  $user_data=User::find(Auth::id());
  $product_data=array();
  foreach(explode(',',$order_data->order_id) as $key=>$val){
          $data=DB::table('productmaster')->select('product_name','mrp')->where('id',$val)->first();
          array_push($product_data,$data);
  }
  return view('website.order-confirmation',compact('order_data','user_data','product_data'));
}

public function add_shipping_address(Request $r){
    
       //$user_data=User::find(Auth::id());
    $addrs=new Shipping();
    $addrs->user_id=Auth::user()->id;
    $addrs->first_name=trim($r->shipping_first_name);
    $addrs->last_name=trim($r->shipping_last_name);
    $addrs->company_name=trim($r->shipping_company);
    $addrs->country=trim($r->shipping_country);
    $addrs->address1=trim($r->shipping_address_1);
    $addrs->address2=trim($r->shipping_address_2);
    $addrs->city=trim($r->shipping_city);
    $addrs->state=trim($r->shipping_state);
    $addrs->pincode=trim($r->shipping_postcode);
    $addrs->mobile=trim($r->shipping_phone);
    $addrs->address_type='shipping';
    $addrs->save();
    $msg='Shiping address added successfully';
     $r->session()->flash('message',$msg);
    return redirect('checkout');
    
}
}

