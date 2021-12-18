<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Storage;
use Str;

use App\Models\Blog;
use App\Models\Product\Category;

class BlogsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getBlogs(Request $r){
        $data['lists']=Blog::orderBy('id','desc')->get();
        return view('admin.blog.list',$data);
    }
    public function addBlog(Request $r){
        $data['cats']=Category::where(['parent_id'=>0,'status'=>1])->orderBy('id','desc')->get();
        $data['subcats']=Category::where('parent_id','!=',0)->where(['status'=>1])->orderBy('id','desc')->get();
        return view('admin.blog.add-edit-blog',$data);
    }
    public function saveBlog(Request $r){
        $validate=Validator::make($r->all(),[
            'cat_id'=>'required|integer',
            'scat_id'=>'required|integer',
            'title'=>'required|string|max:200',
            'description'=>'required',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Blog::find($r->id);
            $msg='Updated';
        }else{
            $msg=Added;
            $detail=new Blog();
            $detail->slug=Str::slug($r->title);
        }
        if($r->file('image') && is_file($r->file('image'))){
            $image = $r->file('image');
            $imagename = time().rand(1000,1).'.'.$image->getClientOriginalExtension();
            $thumbPath = getcwd().'/storage/app/blogs/thumbnails/';
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath.$imagename);
            $destinationPath = getcwd().'/storage/app/blogs/images/';
            $img->resize(1920, 450, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$imagename);
            if($detail->image){
                $thumbImg='';
                $dImg='';
            }
            $detail->image=$imagename;
        }
        
        $detail->title=trim($r->title);
        $detail->description=trim($r->description);
        $detail->cat_id=$r->cat_id;
        $detail->scat_id=$r->scat_id;
        try {
            $detail->save();
            return back()->with('success',$msg);
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            dd($msg);
            return back()->with('error',ServerError);
        }
    }
    public function editBlog(Request $r,$id){
        $data['blog']=Blog::find($id);
        $data['cats']=Category::where(['parent_id'=>0,'status'=>1])->orderBy('id','desc')->get();
        $data['subcats']=Category::where('parent_id','!=',0)->where(['status'=>1])->orderBy('id','desc')->get();
        return view('admin.blog.add-edit-blog',$data);

    }
     public function deleteBlog(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Blog::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    public function statusBlog(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer',
            'status'=>'required|in:0,1'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Blog::where('id',$r->id)->update(['status'=>$r->status]);
        if($detail){
            return array('status'=>1,'message'=>StatusUpdate);
        }else{
            return array('status'=>0,'message'=>NotStatusUpdate);
        }
    }

}
