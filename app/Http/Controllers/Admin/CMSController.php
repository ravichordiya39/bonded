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
use App\Models\Common\Banner;

class CMSController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //start banner functionality
    public function getBanners(Request $r){
        $data['lists']=Banner::orderBy('id','desc')->get();
        return view('admin.cms.banner',$data);
    }
    
    public function saveBanner(Request $r){
        
        $validate=Validator::make($r->all(),[
            'heading'=>'required|max:200',
            'image'=>'required|dimensions:min_width=500,max_width=2000',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Banner::find($r->id);
            $msg=Updated;
        }else{
            $detail=new Banner();
            $msg=Added;
        }
        if($r->has('image') && $r->file('image') && is_file($r->file('image'))){
           
            $image = $r->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $thumbPath = getcwd().'/storage/app/banner/thumbnails/';
            $img = Image::make($image->getRealPath());
            $destinationPath = getcwd().'/storage/app/banner/images/';
            $img->resize(1920, 720, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath.$imagename);
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath.$imagename);
            // $image->move($destinationPath,$imagename);
            if($detail->image){
                $thumbImg=$thumbPath.$detail->image;
                $dImg=$destinationPath.$detail->image;
                if(file_exists($thumbImg)){
                    unlink($thumbImg);
                }
                if(file_exists($dImg)){
                    unlink($dImg);
                }
            }
            $detail->image=$imagename;
        }else{
            $detail->image=$r->preImage;
        }
        if(isset($r->is_exclusive)){
        $detail->btype='exclusive';
         Banner::where('btype','exclusive')->delete();
        }else{
        $detail->btype='banner';
      }
      $detail->heading=$r->heading??$detail->heading;
      $detail->description=$r->description;
      
      $detail->link=$r->link;
     $re =  $detail->save();
     if($re){
         return back()->with('success',$msg);
     }else{
        return back()->with('error',ServerError);
     }
      
       
    }
    
    
    
    public function editBanner(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Banner::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteBanner(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Banner::find($r->id);
        if($detail){
            $thumbPath = getcwd().'/storage/app/banner/thumbnails/';
            $destinationPath = getcwd().'/storage/app/banner/images/';
            if($detail->image){
                $thumbImg=$thumbPath.$detail->image;
                $dImg=$destinationPath.$detail->image;
                if(file_exists($thumbImg)){
                    unlink($thumbImg);
                }
                if(file_exists($dImg)){
                    unlink($dImg);
                }
            }
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    public function statusBanner(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer',
            'status'=>'required|in:0,1'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Banner::where('id',$r->id)->update(['status'=>$r->status]);
        if($detail){
            return array('status'=>1,'message'=>StatusUpdate);
        }else{
            return array('status'=>0,'message'=>NotStatusUpdate);
        }
    }
    //end banner functionality
    //cms/pages functionality start
    public function getCMS(Request $r){
        $data['lists']=CMS::orderBy('id','desc')->get();
        return view('admin.cms.list',$data);
    }
    public function addCMS(Request $r){
        $data=array();
        return view('admin.cms.add-edit-page',$data);
    }
    public function saveCMS(Request $r){
        if($r->ctype=='faq'){
            $validate=Validator::make($r->all(),[
                'ctype'=>'required',
                'title'=>'required|string|max:200',
            ]);
        }else{
            $validate=Validator::make($r->all(),[
                'ctype'=>'required',
                'ftype'=>'required',
                'title'=>'required|string|max:200',
                'description'=>'required',
            ]);
        }
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        // dd($r->all());
        if($r->id){
            $detail= CMS::find($r->id);
            $msg='Updated';
        }else{
            if(CMS::where('ctype',$r->ctype)->exists()){
                return back()->with('warning',Exists);
            }
            $msg=Added;
            $detail=new CMS();
            $detail->slug=Str::slug($r->title);
        }
        if($r->file('image') && is_file($r->file('image'))){
            $image = $r->file('image');
            $imagename = time().rand(1000,1).'.'.$image->getClientOriginalExtension();
            $thumbPath = getcwd().'/storage/app/cms/thumbnails/';
            $destinationPath = getcwd().'/storage/app/cms/images/';
            $img = Image::make($image->getRealPath());
            $img->resize(1920, 550, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath.$imagename);
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath.$imagename);
            if($detail->image){
                $thumbImg=$thumbPath.$detail->image;
                $dImg=$destinationPath.$detail->image;
                if(file_exists($thumbImg)){
                    unlink($thumbImg);
                }
                if(file_exists($dImg)){
                    unlink($dImg);
                }
            }
            $detail->image=$imagename;
        }
        $detail->ctype=$r->ctype;
        $detail->ftype=$r->ftype;
        $detail->title=trim($r->title);
        $detail->description=trim($r->description);
        if(isset($r->qa) && is_array($r->qa)){
            $detail->description=json_encode($r->qa);
        }
        try {
            $detail->save();
            return back()->with('success',$msg);
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            dd($msg);
            return back()->with('error',ServerError);
        }
    }
    public function editCMS(Request $r,$id){
        $data['page']=CMS::find($id);
        if($data['page'] && $data['page']->ctype=='faq'){
            return view('admin.cms.faq',$data);
        }
        return view('admin.cms.add-edit-page',$data);

    }
     public function deleteCMS(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=CMS::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    public function statusCMS(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer',
            'status'=>'required|in:0,1'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=CMS::where('id',$r->id)->update(['status'=>$r->status]);
        if($detail){
            return array('status'=>1,'message'=>StatusUpdate);
        }else{
            return array('status'=>0,'message'=>NotStatusUpdate);
        }
    }
    //end cms/page functionality

}
