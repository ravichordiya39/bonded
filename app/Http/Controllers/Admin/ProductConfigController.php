<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Storage;
use Str;

use App\Models\Product\Size;
use App\Models\Product\Brand;
use App\Models\Product\Color;
use App\Models\Product\Occasion;
use App\Models\Product\Design;
use App\Models\Product\Fabric;
use App\Models\Product\Material;
use App\Models\Product\Pattern;

class ProductConfigController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('superadmin');
    }
    //brand start
    public function getBrands(Request $r){
        $data['lists']=Brand::orderBy('id','desc')->get();
        return view('admin.product.config.brand',$data);
    }
    public function saveBrand(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100'
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $config= Brand::find($r->id);
            $msg=Updated;
        }else{
            $config=new Brand();
            $msg=Added;
            $config->slug=Str::slug($r->name);
        }
        if($r->file('image') && is_file($r->file('image'))){
            $image = $r->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $thumbPath = getcwd().'/storage/app/brand/thumbnails/';
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath.$imagename);
            $destinationPath = getcwd().'/storage/app/brand/images/';
            $image->move($destinationPath,$imagename);
            if($config->logo){
                $thumbImg='';
                $dImg='';
            }
            $config->logo=$imagename;
        }
        $config->name=$r->name??$config->name;
        $config->status=$r->status??0;
        try {
            $config->save(); 
            return back()->with('success',$msg);
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            return back()->with('error',ServerError);
        }
    }
    public function editBrand(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Brand::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteBrand(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Brand::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //brand end
    //Size config start
    public function getSizes(Request $r){
        $data['lists']=Size::orderBy('id','desc')->get();
        return view('admin.product.config.size',$data);
    }
    public function saveSize(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
            'size'=>'required',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Size::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->size=$r->size;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Size::updateOrCreate(['size'=>$r->size],['status'=>$r->status,'name'=>$r->name,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editSize(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Size::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteSize(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Size::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //size config end
    //Start Color Config
    public function getColors(Request $r){
        $data['lists']=Color::orderBy('id','desc')->get();
        return view('admin.product.config.color',$data);
    }
    public function saveColor(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
            'color_code'=>'required',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Color::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->color_code=$r->color_code;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Color::updateOrCreate(['color_code'=>$r->color_code],['status'=>$r->status,'name'=>$r->name,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editColor(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Color::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteColor(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Color::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end color
    //Start Occasion Config
    public function getOccasions(Request $r){
        $data['lists']=Occasion::orderBy('id','desc')->get();
        return view('admin.product.config.occasion',$data);
    }
    public function saveOccasion(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Occasion::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Occasion::updateOrCreate(['name'=>$r->name],['status'=>$r->status,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editOccasion(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Occasion::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteOccasion(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Occasion::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end Occasion
    //Start Fabric Config
    public function getFabrics(Request $r){
        $data['lists']=Fabric::orderBy('id','desc')->get();
        return view('admin.product.config.fabric',$data);
    }
    public function saveFabric(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Fabric::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Fabric::updateOrCreate(['name'=>$r->name],['status'=>$r->status,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editFabric(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Fabric::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteFabric(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Fabric::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end Fabric
    //Start Design Config
    public function getDesigns(Request $r){
        $data['lists']=Design::orderBy('id','desc')->get();
        return view('admin.product.config.design',$data);
    }
    public function saveDesign(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Design::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Design::updateOrCreate(['name'=>$r->name],['status'=>$r->status,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editDesign(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Design::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteDesign(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Design::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end Design
    //Start Material Config
    public function getMaterials(Request $r){
        $data['lists']=Material::orderBy('id','desc')->get();
        return view('admin.product.config.material',$data);
    }
    public function saveMaterial(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Material::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Material::updateOrCreate(['name'=>$r->name],['status'=>$r->status,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editMaterial(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Material::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deleteMaterial(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Material::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end Material
    //Start Pattern Config
    public function getPatterns(Request $r){
        $data['lists']=Pattern::orderBy('id','desc')->get();
        return view('admin.product.config.pattern',$data);
    }
    public function savePattern(Request $r){
        $validate=Validator::make($r->all(),[
            'name'=>'required|max:100',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Pattern::find($r->id);
            $msg='Updated';
            $detail->name=$r->name;
            $detail->status=$r->status;
            try {
                $detail->save();
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }else{
            $msg=Added;
            try {
                $detail=Pattern::updateOrCreate(['name'=>$r->name],['status'=>$r->status,'slug'=>Str::slug($r->name)]);
                return back()->with('success',$msg);
            } catch (\Exception $e) {
                $msg=$e->getMessage();
                return back()->with('error',ServerError);
            }
        }
    }
    public function editPattern(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Pattern::find($r->id);
        if($detail){
            return array('status'=>1,'message'=>Get,'data'=>$detail);
        }else{
            return array('status'=>0,'message'=>NotGet);
        }
    }
    public function deletePattern(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Pattern::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    //end Pattern
}
