<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function getLayout(){
	$layout='layouts.default';
	if(Auth::check()){
		$user=Auth::user();
		if($user->user_type=='user'){
			$layout='layouts.user';
		}
	}
	return $layout;
}
function getCurrentUser(){
    $data['user_id']=0;
    $data['user_type']='';
    if(Auth::check()){
        $user=Auth::user();
        $data['user_id']=$user->id;
        $data['user_type']=$user->user_type;
    }
    return $data;
}
if (!function_exists('pr')) {
    function pr($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
if (!function_exists('prd')) {
    function prd($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }
}

function productGalleryImg($name=''){
	if($name){
		return url('storage/app/product/gallery/images').'/'.$name;
	}
	return false;
}
function productGalleryThumbnail($name=''){
	if($name){
		return url('storage/app/product/gallery/thumbnails').'/'.$name;
	}
	return false;
}
function productGalleryOneThumbnail($name=''){
	if($name){
		return url('storage/app/product/images').'/'.$name;
	}
	return false;
}
function dateFormat($date,$format='M d, Y'){
    return date($format,strtotime($date));
}
function systemInfo(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform    = "Unknown OS Platform";
    $os_array       = array('/windows phone 8/i'    =>  'Windows Phone 8',
                            '/windows phone os 7/i' =>  'Windows Phone 7',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile');
    $found = false;
    $device = '';
    foreach ($os_array as $regex => $value) 
    { 
        if($found)
         break;
        else if (preg_match($regex, $user_agent)) 
        {
            $os_platform    =   $value;
            $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                      ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
        }
    }
    $device = !$device? 'SYSTEM':$device;
    return array('os'=>$os_platform,'device'=>$device);
 }

 function checkCurrencySession(){
    $currencySession = Session::get('Currency');
    if($currencySession){
        if($currencySession =='INR'){
            $cArray = ['column_name'=>'inr_price','sell_column'=>'inr_sell_price','icon'=>'₹','type'=>'INR'];
        }
        else{
            $cArray = ['column_name'=>'usd_price','sell_column'=>'usd_sell_price','icon'=>'$','type'=>'USD'];
        }
      
    }
    else{
        $cArray = ['column_name'=>'inr_price','sell_column'=>'inr_sell_price','icon'=>'₹','type'=>'INR'];
    }
    return  $cArray;
 }

 function couponApply(){
    $couponList = Session::get('code');
    if($couponList){
        $coupon = [
            'type_coupon' => $couponList['type_coupon'],
            'coupon_discount' => $couponList['coupon_discount'],
            'coupon_name' => $couponList['coupon_name'],
        ];
    
    }
    else{
        $coupon = [
            'type_coupon' => '',
            'coupon_discount' => 0.00,
            'coupon_name' =>'',
            
        ];
   
    }
    return $coupon;

 }

 if(!function_exists('getPriceDiffPercent')){
     function getPriceDiffPercent($oldFigure,$newFigure){
        if (($oldFigure != 0) && ($newFigure != 0)) {
            $percentChange = (($oldFigure - $newFigure) / $oldFigure) * 100;
            return round(abs($percentChange));
        }
        else{
            return null;
        }
        
     }

 }