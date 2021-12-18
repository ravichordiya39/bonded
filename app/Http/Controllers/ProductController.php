<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product\Category;
use App\Models\Product;
use App\Http\Libs\ProductLib;
use Illuminate\Support\Facades\Session;
use App\Models\Common\Config;
use App\Models\Product\ProductBookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller{
   
    public function getProducts(Request $r){
      
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data=$filter=$r->all();
        $data['count']=0;
        $count = Product::where('status','=','1')->count();
        $filter['paginate'] =$count;
        $filter['ajax']['wish']=Auth::id();
        $filter['status']=1;
        $plib=new ProductLib();
        $data['products']=$plib->productList($filter);
        $data['layout']=getLayout();
        $data['count']=$count;
        return view('product.list',$data);

    }
    public function getExclusiveProducts(Request $r){
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data=$filter=$r->all();
        $filter['ajax']['wish']=Auth::id();
        $plib=new ProductLib();
        $filter['status']=1;
        $filter['is_exclusive']=1;
        $data['products']=$plib->productList($filter);
        $data['layout']=getLayout();
        return view('product.list',$data);

    }

    public function getCatProduct(Request $r,$cat){
        $cType = checkCurrencySession();
       
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data=$filter=$r->all();
        $category=Category::where(['slug'=>$cat])->first();
       
        if($r->ajax())
        {
            if($r->id != null && $r->type=='color'){
                $search = $r->id;
                
            }
            elseif($r->id != null && $r->type=='size'){
                $search = $r->id;
            }
            
            
        }
        if($category){
            if($r->ajax())
        {
            if($r->id != null && $r->type=='color'){
                $filter['ajax']['color'] = $r->id;
            }
            elseif($r->id != null && $r->type=='size'){
                $filter['ajax']['size'] = $r->id;
            }
            
        }
            $filter['ajax']['wish']=Auth::id();
            $data['count']=0;
            $count = Product::where('status','=','1')->where('cat_id','=',$category->id)->count();
            $filter['paginate'] =9;
            $filter['status']=1;
            $filter['cat_id']=$category->id;
            $data['category']=$category;
            $plib=new ProductLib();
            $data['products']=$plib->productList($filter);
            $data['layout']=getLayout();
            $data['count']=$count;
            return view('product.list',$data);
        }else{
            
            return redirect('product/list')->with('warning',NotExists);
        }
    }
    public function getSubCatProduct(Request $r,$cat,$scat){
       
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data=$filter=$r->all();
        $category=Category::where(['slug'=>$cat])->first();
        #$subcategory=Category::where(['slug'=>$scat])->first();
        $filter['ajax']['wish']=Auth::id();
        $subcategory= $category->scat()->where(['slug'=>$scat])->first();
        if($category && $subcategory){
            $count = Product::where('status','=','1')->where(['cat_id'=>$category->id,'scat_id'=>$subcategory->id])->count();
            $data['count']=$count;
            $filter['status']=1;
            $filter['cat_id']=$category->id;
            $filter['scat_id']=$subcategory->id;
            $data['category']=$category;
            $data['subcategory']=$subcategory;
            $plib=new ProductLib();
            $data['products']=$plib->productList($filter);
            $data['layout']=getLayout();
            return view('product.list',$data);
        }else{
            return redirect('product/list')->with('warning',NotExists);
        }

        
    }

    public function getProductJson(Request $request, $cat=null)
    {
        if ($request->has('orderby') && $request->orderby !='' && !empty($request->orderby)) {

            $orderby = $request->input('orderby');
            $oarr = explode(",", $orderby);
            
            if($oarr[0]!='is_exclusive'){
                $filter['sortby']= $oarr[0];
                $filter['sorttype']= $oarr[1];
            }
            else{
                $filter['is_exclusive']= 1;
            }
		    
        }

        $request->minimum_price;
        $request->productName;
        $request->maximum_price;
        $request->sorting;
        $request->color;
        $request->size;
        if(isset($cat) && $cat !='list' && $cat !=''){
            $category=Category::where(['slug'=>$cat])->first();
            $filter['cat_id']=$category->id;
        }
        
        $filter['ajax']['wish']=Auth::id();
        if(!empty($request->color) && isset($request->color)){
            $filter['ajax']['color'] = $request->color;
        }
        if(!empty($request->size) && isset($request->size)){
            $filter['ajax']['size'] = $request->size;
        }
        if(!empty($request->subCategegory) && isset($request->subCategegory)){
            $filter['scat_id'] = $request->subCategegory;
        }
        if(!empty($request->subCategegory) && isset($request->subCategegory)){
            $category=Category::where(['slug'=>$cat])->first();
            $subcategory= $category->scat()->where(['slug'=>$request->subCategegory])->first();
            $filter['scat_id'] = $subcategory->id;
        }
        if(!empty($request->price) && isset($request->price)){
            $price = $request->price;
            for($i=0;$i<count($price);$i++){
                $prices = explode('_',$price[$i]);
                $priceMin[] = $prices[0];
                $priceMax[] = $prices[1];
            }
            $min = min($priceMin);
            $max = max($priceMax);
            $filter['ajax']['price'] = $min;
            $filter['ajax']['priceMax'] = $max;
        }

        $plib=new ProductLib();
        $products = $plib->productList($filter);
        $html = view("product.product-ajax", ['products' => $products])->render();
        return response()->json(["html" => $html, "next_page_url" => $products->nextPageUrl()]);
    }


    public function getProductDetail(Request $r,$slug=''){
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data=$filter=$r->all();
        $data['detail']=$detail=Product::where(['slug'=>$slug])->first();
        if(!$detail && empty($detail)){
            return redirect('product/list')->with('warning',NotExists);
        }
        $data['rlists']=Product::where(['status'=>1,'scat_id'=>$detail->scat_id])->where('id','!=',$detail->id)->orderBy('id','desc')->take(10)->get();
        $data['layout']=getLayout();
        $data['contact_phone']=Config::where(['ctype'=>'front','status'=>1,'key_name'=>'contact_phone'])->first();
        $data['contact_email']=Config::where(['ctype'=>'front','status'=>1,'key_name'=>'contact_email'])->first();
        return view('product.detail',$data);
    }



    public function addRemoveFav(Request $request)
	{
        if(Auth::id()){
            $productId = $request->productId;
            $userIp = $request->ip();
            $products =  Product::find($productId);
            if($products){
             # $recent =  ProductBookmark::where('product_id',$productId)->where('user_id',DB::raw('"'.$userIp.'"'))->first();
              $recent =  ProductBookmark::where('product_id',$productId)->where('user_id',Auth::id())->first();
                if($recent){
                    ProductBookmark::where("product_id",$productId)->where('user_id',Auth::id())->delete();
                    $data['message'] = 'Remove';
                    $data['statusCode'] = 200;
                }
                else{
                    $userforgeBiyu = ProductBookmark::create([
                        'product_id'=>$productId,
                        'user_id'=>Auth::id()
                    ]);
                    $data['message'] = 'Add';
                    $data['statusCode'] = 200;
                }
    
    
            }
            else{
                $data['statusCode']= 203;
                $data['message']="Please Login First";
            
            }
        }
        else{
            $data['statusCode']= 201;
            $data['message']="Please Login First";
        }
		
        return response()->json($data);
	}
    //change currency in default
    public function currencyUpdate(Request $r){
        $currency = $r->currency;
        if($currency =='INR'){
            session()->put('Currency','INR');
        }
        elseif($currency =='USD'){
            session()->put('Currency','USD');
        }
        else{
            session()->put('Currency','INR'); 
        }
        $data['statusCode']= 200;
        $data['message']="Currency Updated";
        return response()->json($data);
    }

    //seraching product
    public function searchProduct(Request $r){
        $serach = $r->search_keyword;
        $output="";

        if ($serach != '') {
            $category=Category::where('name','like', '%'.$serach.'%')->get();
            if($category) {
                foreach ($category as $key => $product) {
                    $output.='<li><a href="'.$product->url.'">'.$product->name.'</a></li>';
                }
            }
            return Response($output);
        }
        
        
    }
}
