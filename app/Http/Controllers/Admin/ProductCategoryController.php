<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Storage;
use Str;

use App\Models\Product\Category;
use App\Models\Product\MapAttribute;
use App\Models\Product\Size;
use App\Models\Product\Brand;
use App\Models\Product\Color;
use App\Models\Product\Occasion;
use App\Models\Product\Design;
use App\Models\Product\Fabric;
use App\Models\Product\Material;
use App\Models\Product\Pattern;

class ProductCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('superadmin');
    }
    public function getCategories(Request $r){
        $data['cats']=Category::where(['parent_id'=>0])->orderBy('id','desc')->get();
        return view('admin.product.category',$data);
    }
    public function getSubCategories(Request $r,$id){
        $data['subcats']=Category::where('parent_id',$id)->orderBy('id','desc')->get();
        $data['category']=Category::find($id);
        if(!$data['category']){
            return redirect('admin/category');
        }
        return view('admin.product.subcategory',$data);
    }
    public function saveCategory(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100'
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $cat= Category::find($r->id);
            $msg=Updated;
        }else{
            $cat=new Category();
            $msg=Added;
            $cat->slug=Str::slug($r->name);
        }
        if($r->file('image') && is_file($r->file('image'))){
            $image = $r->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $thumbPath = getcwd().'/storage/app/category/thumbnails/';
            $img = Image::make($image->getRealPath());
            $destinationPath = getcwd().'/storage/app/category/images/';
            $img->resize(1000, 1000, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath.$imagename);
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath.$imagename);
            // $image->move($destinationPath,$imagename);
            if($cat->cat_image){
                $thumbImg=$thumbPath.$cat->cat_image;
                $dImg=$destinationPath.$cat->cat_image;
                if(file_exists($thumbImg)){
                    unlink($thumbImg);
                }
                if(file_exists($dImg)){
                    unlink($dImg);
                }
            }
            $cat->cat_image=$imagename;
        }
      $cat->name=$r->name??$cat->name;
      $cat->is_home=$r->is_home??0;
      $cat->is_menu=$r->is_menu??0;
      $cat->status=$r->status??0;
      $cat->parent_id=$r->parent_id??0;
      try {
        $cat->save(); 
        return back()->with('success',$msg);
      } catch (\Exception $e) {
        $msg=$e->getMessage();
        return back()->with('error',ServerError);
      }
    }
    public function editCategory(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Category::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteCategory(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Category::find($r->id);
        if($detail){
            Category::where('parent_id',$detail->id)->delete();
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //Start Map Attribute functionality
    public function getMapAttributes(Request $r){
        $data['lists']=MapAttribute::orderBy('id','desc')->get();
        return view('admin.product.map-attribute',$data);
    }
    public function addMapAttribute(Request $r){
        $data['colors']=Color::orderBy('name','desc')->get();
        $data['cats']=Category::where(['parent_id'=>0,'status'=>1])->orderBy('name','desc')->get();
        $data['brands']=Brand::orderBy('name','desc')->get();
        $data['sizes']=Size::orderBy('name','desc')->get();
        $data['patterns']=Pattern::orderBy('name','desc')->get();
        $data['occasions']=Occasion::orderBy('name','desc')->get();
        $data['fabrics']=Fabric::orderBy('name','desc')->get();
        $data['designs']=Design::orderBy('name','desc')->get();
        $data['materials']=Material::orderBy('name','desc')->get();
        return view('admin.product.add-edit-attribute',$data);
    }
    public function editMapAttribute(Request $r,$id){
        $detail=MapAttribute::find($r->id);
        if($detail){
            $data['attribute']=$detail;
            $data['colors']=Color::orderBy('name','desc')->get();
            $data['cats']=Category::where(['parent_id'=>0,'status'=>1])->orderBy('name','desc')->get();
            $data['brands']=Brand::orderBy('name','desc')->get();
            $data['sizes']=Size::orderBy('name','desc')->get();
            $data['patterns']=Pattern::orderBy('name','desc')->get();
            $data['occasions']=Occasion::orderBy('name','desc')->get();
            $data['fabrics']=Fabric::orderBy('name','desc')->get();
            $data['designs']=Design::orderBy('name','desc')->get();
            $data['materials']=Material::orderBy('name','desc')->get();
            return view('admin.product.add-edit-attribute',$data);
        }else{
            return back()->with('error',NotGet);
        }
    }
    public function saveMapAttribute(Request $r){
        if($r->id){
            $validate=Validator::make($r->all(),[
                'id'=>'required|integer',
                'cat_id'=>'required|integer'
            ]);
        }else{
            $validate=Validator::make($r->all(),[
                'cat_id'=>'required|integer|unique:map_attributes'
            ]);
        }
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= MapAttribute::find($r->id);
            $msg='Updated';
        }else{
            $msg=Added;
            $detail=new MapAttribute();
        }
        $detail->cat_id=$r->cat_id;
        $detail->is_size=$r->is_size??0;
        $detail->sizes=(isset($r->sizes) && is_array($r->sizes))?json_encode($r->sizes):null;
        $detail->is_color=$r->is_color??0;
        $detail->colors=(isset($r->colors) && is_array($r->colors))?json_encode($r->colors):null;
        $detail->is_brand=$r->is_brand??0;
        $detail->brands=(isset($r->brands) && is_array($r->brands))?json_encode($r->brands):null;
        $detail->is_pattern=$r->is_pattern??0;
        $detail->patterns=(isset($r->patterns) && is_array($r->patterns))?json_encode($r->patterns):null;
        $detail->is_occasion=$r->is_occasion??0;
        $detail->occasions=(isset($r->occasions) && is_array($r->occasions))?json_encode($r->occasions):null;
        $detail->is_fabric=$r->is_fabric??0;
        $detail->fabrics=(isset($r->fabrics) && is_array($r->fabrics))?json_encode($r->fabrics):null;
        $detail->is_design=$r->is_design??0;
        $detail->designs=(isset($r->designs) && is_array($r->designs))?json_encode($r->designs):null;
        $detail->is_material=$r->is_material??0;
        $detail->materials=(isset($r->materials) && is_array($r->materials))?json_encode($r->materials):null;
        $detail->status=$r->status??1;
        try {
            $detail->save();
            return back()->with('success',$msg);
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            dd($msg);
            return back()->with('error',ServerError);
        }
    }
    public function deleteMapAttribute(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=MapAttribute::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end Map attribute
}
