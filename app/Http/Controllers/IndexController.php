<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Product\Category;
use App\Models\Product;
use App\Models\Common\Banner;
use App\Models\CMS;
use Auth;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\Location\City;
use App\Models\Order;
use App\Models\Subscribe;
use Mail;
class IndexController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $r){
        $r->session()->put('redirecturlafterlogin',url()->current());
    	$data['banners']=Banner::where(['btype'=>'banner','status'=>1])->get();
        $data['exclusive']=Banner::where(['btype'=>'exclusive','status'=>1])->latest()->first();
        $data['cats']=Category::where(['is_home'=>1,'status'=>1])->take(5)->get();
        $data['hplists']=Product::where(['is_home'=>1,'status'=>1])->take(5)->get();
        $data['about']=CMS::where(['ctype'=>'about','status'=>1])->first();
        $data['layout']=getLayout();
        return view('index',$data);
    }
    public function getPage(Request $r,$page=''){
        $data['page']=CMS::where(['slug'=>$page,'status'=>1])->first();
        if(!$data['page']){
            return redirect('/')->with('warning',NotExists);
        }
        $data['layout']=getLayout();
        if($data['page']->ctype=='faq'){
            return view('pages.faq',$data);
        }else{
            return view('pages.page',$data);
        }
        return view('pages.page',$data);
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'=> 'required|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'country_code' => $r->country_code??91,
            'password' => Hash::make($r->password),
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
    public function getSubCats(Request $r){
        if($r->cat_id){
            $html='';
            $subcats=Category::where(['parent_id'=>$r->cat_id,'status'=>1])->orderBy('name','asc')->get();
            $html.='<option value="">Choose Sub Category</option>';
            foreach ($subcats as $scat){
                $html.='<option value="'.$scat->id.'" selected>'.$scat->name.'</option>';
            }
            return array('status'=>1,'message'=>Get,'data'=>$html);
        }else{
            return array('status'=>0,'message'=>FieldRequired);
        }
    }
    public function getLocation(Request $r){
        if($r->rtype=='state' && $r->country_id){
            $cid=$r->country_id;
            $html='';
            $lists=State::where(['country_id'=>$cid])->orderBy('name','asc')->get();
            $html.='<option value="">Choose State</option>';
            foreach ($lists as $list){
                $html.='<option data-id="'.$list->id.'" value="'.$list->name.'" selected>'.$list->name.'</option>';
            }
            return array('status'=>1,'message'=>Get,'data'=>$html);
        }elseif($r->rtype=='city' && $r->state_id){
            $cid=$r->state_id;
            $html='';
            $lists=City::where(['state_id'=>$cid])->orderBy('name','asc')->get();
            $html.='<option value="">Choose City</option>';
            foreach ($lists as $list){
                $html.='<option data-id="'.$list->id.'" value="'.$list->name.'" selected>'.$list->name.'</option>';
            }
            return array('status'=>1,'message'=>Get,'data'=>$html);
        }else{
            return array('status'=>0,'message'=>FieldRequired);
        }
    }
    public function deleteImageFile(Request $r){
        if(Auth::check() && $r->file && $r->ftype){
            if($r->ftype=='productGallery'){
                $thumbPath = getcwd().'/storage/app/product/gallery/thumbnails/';
                $destinationPath = getcwd().'/storage/app/product/gallery/images/';
                $thumbImg=$thumbPath.$r->file;
                $dImg=$destinationPath.$r->file;
                if(file_exists($thumbImg)){
                    unlink($thumbImg);
                }
                if(file_exists($dImg)){
                    unlink($dImg);
                }
            }
            return array('status'=>1,'message'=>Get);
        }else{
            return array('status'=>0,'message'=>FieldRequired);
        }
    }
    function checkM(){
        
        $user=Auth::user();
        $ca['order_id'] = 'OD21102307000012';
        $single=Order::where(['user_id'=>$user->id,'order_id'=>$ca['order_id']])->first();
        $lists=Order::where(['user_id'=>$user->id,'order_id'=>$ca['order_id']])->get();
       
        #$data = View('emails.order-pdf', ['single'=>$single,'lists'=>$lists])->render();
       # return view('emails.order-pdf',['single'=>$single,'lists'=>$lists]);
        // SendEmailByTemplate(6,$user['email'],array(
        //     'NAME' => $user['name'],
        //     'CART_DATA' => $data,
        // ),'emails.register'
        // );
        // $data['single'] = $single;
        // $data['lists'] = $lists;
        // $emails = 'kaushal8139@gmail.com';
        // Mail::send('emails.order-pdf', $data, function($message) use($emails) {
        //     $message->to($emails, 'kaushal')->subject
        //       ('Ordered Successfully | Sekhawati');
        //     $message->from('account@abeerjaipur.com','Abeer Jaipur');
        //  });
        // //  return true;
        $path = storage_path('app/pdf/orders');
        $filename = "order_{$single->order_id}";
        // # $pdf = PDF::loadView('order-pdf',  ['orders'=>$orders,'title'=>'test','active'=>'test']);
         $pdf = PDF::loadView('emails.order-pdf',  ['single'=>$single,'lists'=>$lists])->save(''.$path.'/'.$filename.'.pdf');
    }
    
     public function subscribe(Request $r){
        $validate=Validator::make($r->all(),[
            'email' => 'required|string|email|max:255',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        $email = $r->email;
        $userIp = $r->ip();
        $user = Subscribe::create([
            'email' => $email,
            'ip'=> $userIp
        ]);
        return back()->with('success','you have subscribe successfully');
    }
}
