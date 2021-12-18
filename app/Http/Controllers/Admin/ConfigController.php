<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Image;
use Storage;
use Str;

use App\Models\CMS;
use App\Models\Common\Config;

class ConfigController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //start Front Config functionality
    public function getFrontConfigs(Request $r){
        $data['lists']=Config::where('ctype','front')->get();
        return view('admin.config.front-list',$data);
    }
    public function saveFrontConfig(Request $r){
        $data=$r->all();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        try {
            foreach($data as $key=>$value){
                $update=Config::where('key_name',$key)->update(['key_value'=>$value]);
            }
            return back()->with('success',Updated);
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            return back()->with('error',ServerError);
        }
    }
    public function editFrontConfig(Request $r){
        $data['lists']=Config::where('ctype','front')->get();
        return view('admin.config.front',$data);

    }
    public function statusFrontConfig(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer',
            'status'=>'required|in:0,1'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Config::where('id',$r->id)->update(['status'=>$r->status]);
        if($detail){
            return array('status'=>1,'message'=>StatusUpdate);
        }else{
            return array('status'=>0,'message'=>NotStatusUpdate);
        }
    }
    //end Front Config functionality
}
