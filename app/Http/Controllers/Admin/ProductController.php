<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Storage;
use Str;

use App\Models\Product;
use App\Models\Product\Category;
use App\Models\Product\ProductDetail;
use App\Models\Product\MapAttribute;
use App\Models\Product\Size;
use App\Models\Product\Brand;
use App\Models\Product\Color;
use App\Models\Product\Occasion;
use App\Models\Product\Design;
use App\Models\Product\Fabric;
use App\Models\Product\Material;
use App\Models\Product\Pattern;
use App\Exports\ProductFormatExport;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('superadmin');
    }
    public function getProducts(Request $r){
        $data['lists'] = Product::orderBy('id','desc')
        ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
        ->select('products.*','categories.name as cat_name')->get();
       
        //$data['lists']=Product::orderBy('id','desc')->get();
        $data['cats']=Category::where(['parent_id'=>0,'status'=>1])->orderBy('name','desc')->get();
        $data['subcats']=Category::where(['parent_id'=>0,'status'=>1])->orderBy('name','desc')->get();
        return view('admin.product.products',$data);
    }
    public function getUploadProduct(Request $r){
        $data=[];
        return view('admin.product.upload',$data);
    }
    public function postUploadProduct(Request $r){
        if($r->isMethod('post')){
            $this->validate(
                $r,
                [
                    'csv_file'=>'required'
                ]
            );
            $path = $r->file('csv_file')->getRealPath();
            $data = Excel::import(new ProductsImport, $path);
        //$result =   Excel::import(new ProductsImport ,request()->file('csv_file'));
        //dd($result);
        return redirect('admin/product/upload')->with('flash_message', 'Import Bulk Products Successfully.');
        }
    }
    public function addProductForm(Request $r){
        $ids=MapAttribute::pluck('cat_id')->all();
        $data['cats']=Category::where(['parent_id'=>0,'status'=>1])->whereIn('id',$ids)->orderBy('name','desc')->get();
        $data['is_cat']=true;
        $data['sizes']=Size::orderBy('name','desc')->get();
        $data['colors']=Color::orderBy('name','desc')->get();
        return view('admin.product.add-product',$data);
    }
    public function addProduct(Request $r,$cat){
        $cat=Category::where('slug',$cat)->first();
        if(!$cat){
            return back()->with('warning',NotExists);
        }
        $data['cat']=$cat;
        $mpattr=MapAttribute::where('cat_id',$cat->id)->first();
        if($mpattr){
            if($mpattr->is_color){
                if($mpattr->colors){
                    $data['colors']=Color::whereIn('id',json_decode($mpattr->colors))->orderBy('name','desc')->get();
                }else{
                    $data['colors']=Color::orderBy('name','desc')->get();
                }
            }else{
                return back()->with('warning',CororRequired);
            }
            if($mpattr->is_size){
                if($mpattr->sizes){
                    $data['sizes']=Size::whereIn('id',json_decode($mpattr->sizes))->orderBy('name','desc')->get();
                }else{
                    $data['sizes']=Size::orderBy('name','desc')->get();
                }
            }else{
                return back()->with('warning',CororRequired);
            }
            $data['subcats']=Category::where('parent_id',$cat->id)->orderBy('name','desc')->get();
            if(!$data['subcats']->count()){
                return back()->with('warning',SubCatRequired);
            }
            if($mpattr->is_brand){
                if($mpattr->brands){
                    $data['brands']=Brand::whereIn('id',json_decode($mpattr->brands))->orderBy('name','desc')->get();
                }else{
                    $data['brands']=Brand::orderBy('name','desc')->get();
                }
            }
            if($mpattr->is_occasion){
                if($mpattr->occasions){
                    $data['occasions']=Brand::whereIn('id',json_decode($mpattr->occasions))->orderBy('name','desc')->get();
                }else{
                    $data['occasions']=Occasion::orderBy('name','desc')->get();
                }
            }
            if($mpattr->is_fabric){
                if($mpattr->fabrics){
                    $data['fabrics']=Fabric::whereIn('id',json_decode($mpattr->fabrics))->orderBy('name','desc')->get();
                }else{
                    $data['fabrics']=Fabric::orderBy('name','desc')->get();
                }
            }
            if($mpattr->is_design){
                if($mpattr->designs){
                    $data['designs']=Design::whereIn('id',json_decode($mpattr->designs))->orderBy('name','desc')->get();
                }else{
                    $data['designs']=Design::orderBy('name','desc')->get();
                }
            }
            if($mpattr->is_pattern){
                if($mpattr->patterns){
                    $data['patterns']=Pattern::whereIn('id',json_decode($mpattr->patterns))->orderBy('name','desc')->get();
                }else{
                    $data['patterns']=Pattern::orderBy('name','desc')->get();
                }
            }
            if($mpattr->is_material){
                if($mpattr->materials){
                    $data['materials']=Material::whereIn('id',json_decode($mpattr->materials))->orderBy('name','desc')->get();
                }else{
                    $data['materials']=Material::orderBy('name','desc')->get();
                }
            }
            // dd($mpattr);
            return view('admin.product.add-product',$data);
        }else{
            return back()->with('warning',NotMapped);
        }
    }
    public function editProduct(Request $r,$id){
        $detail=Product::find($r->id);
        if($detail){
            $data['product']=$detail;
            $data['cat']=Category::find($detail->cat_id);
            $mpattr=MapAttribute::where('cat_id',$detail->cat_id)->first();
            if($mpattr){
                if($mpattr->is_color){
                    if($mpattr->colors){
                        $data['colors']=Color::whereIn('id',json_decode($mpattr->colors))->orderBy('name','desc')->get();
                    }else{
                        $data['colors']=Color::orderBy('name','desc')->get();
                    }
                }else{
                    return back()->with('warning',CororRequired);
                }
                if($mpattr->is_size){
                    if($mpattr->sizes){
                        $data['sizes']=Size::whereIn('id',json_decode($mpattr->sizes))->orderBy('name','desc')->get();
                    }else{
                        $data['sizes']=Size::orderBy('name','desc')->get();
                    }
                }else{
                    return back()->with('warning',CororRequired);
                }
                $data['subcats']=Category::where('parent_id',$detail->cat_id)->orderBy('name','desc')->get();
                if(!$data['subcats']->count()){
                    return back()->with('warning',SubCatRequired);
                }
                if($mpattr->is_brand){
                    if($mpattr->brands){
                        $data['brands']=Brand::whereIn('id',json_decode($mpattr->brands))->orderBy('name','desc')->get();
                    }else{
                        $data['brands']=Brand::orderBy('name','desc')->get();
                    }
                }
                if($mpattr->is_occasion){
                    if($mpattr->occasions){
                        $data['occasions']=Brand::whereIn('id',json_decode($mpattr->occasions))->orderBy('name','desc')->get();
                    }else{
                        $data['occasions']=Occasion::orderBy('name','desc')->get();
                    }
                }
                if($mpattr->is_fabric){
                    if($mpattr->fabrics){
                        $data['fabrics']=Fabric::whereIn('id',json_decode($mpattr->fabrics))->orderBy('name','desc')->get();
                    }else{
                        $data['fabrics']=Fabric::orderBy('name','desc')->get();
                    }
                }
                if($mpattr->is_design){
                    if($mpattr->designs){
                        $data['designs']=Design::whereIn('id',json_decode($mpattr->designs))->orderBy('name','desc')->get();
                    }else{
                        $data['designs']=Design::orderBy('name','desc')->get();
                    }
                }
                if($mpattr->is_pattern){
                    if($mpattr->patterns){
                        $data['patterns']=Pattern::whereIn('id',json_decode($mpattr->patterns))->orderBy('name','desc')->get();
                    }else{
                        $data['patterns']=Pattern::orderBy('name','desc')->get();
                    }
                }
                if($mpattr->is_material){
                    if($mpattr->materials){
                        $data['materials']=Material::whereIn('id',json_decode($mpattr->materials))->orderBy('name','desc')->get();
                    }else{
                        $data['materials']=Material::orderBy('name','desc')->get();
                    }
                }
                return view('admin.product.edit-product',$data);
            }else{
                return back()->with('warning',NotMapped);
            }
            // $data['colors']=Color::orderBy('name','desc')->get();
            // $data['subcats']=Category::where('parent_id',$detail->cat_id)->orderBy('name','desc')->get();
            // $data['brands']=Brand::orderBy('name','desc')->get();
            // $data['sizes']=Size::orderBy('name','desc')->get();
            // $data['patterns']=Pattern::orderBy('name','desc')->get();
            // $data['occasions']=Occasion::orderBy('name','desc')->get();
            // $data['fabrics']=Fabric::orderBy('name','desc')->get();
            // $data['designs']=Design::orderBy('name','desc')->get();
            // $data['materials']=Material::orderBy('name','desc')->get();
            // return view('admin.product.edit-product',$data);
        }else{
            return back()->with('error',NotGet);
        }
    }
    public function saveProduct(Request $r){
        $validate=Validator::make($r->all(),[
            'cat_id'=>'required|integer',
            'scat_id'=>'required|integer',
            'name'=>'required|string|max:200',
            'p_description'=>'required',
            'description'=>'required',
            'shipping'=>'required',
        ]);
        if($validate->fails()){
            return back()->with('error',$validate->errors()->first())->withInput();
        }
        if($r->id){
            $detail= Product::find($r->id);
            $msg='Updated';
            $isnew=0;
        }else{
            $msg=Added;
            $detail=new Product();
            $detail->slug=Str::slug($r->name);
            $isnew=1;
        }
        $detail->name=$r->name;
        $detail->cat_id=$r->cat_id;
        $detail->scat_id=$r->scat_id;
        $detail->sku=$r->sku;
        $detail->hsn_code=$r->hsn_code;
        $detail->gst=$r->gst;
        $detail->is_home=$r->is_home??0;
        $detail->is_exclusive=$r->is_exclusive??0;
        $detail->brand=$r->brand;
        $detail->design=$r->design;
        $detail->material=$r->material;
        $detail->pattern=$r->pattern;
        $detail->fabric=$r->fabric;
        $detail->occasion=$r->occasion;
        $detail->details=(isset($r->product) && is_array($r->product))?json_encode($r->product):null;
        $detail->description=$r->description;
        $detail->p_description=$r->p_description;
        $detail->shipping=$r->shipping;
        if($r->file('image') && is_file($r->file('image'))){
            $image = $r->file('image');
            $imagename = $detail->slug.time().rand(1000,1).'.'.$image->getClientOriginalExtension();
            $thumbPath = getcwd().'/storage/app/product/thumbnails/';
            $destinationPath = getcwd().'/storage/app/product/images/';
            $img = Image::make($image->getRealPath());
            $img->resize(768, 1024, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($destinationPath.$imagename);
            $img->resize(325, 433, function ($constraint) {
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
        }
        $galleryimg=array();
        if(isset($r->sgallery) && is_array($r->sgallery)){
            $galleryimg=$r->sgallery;
        }
        if(isset($r->gallery) && is_array($r->gallery)){
            foreach($r->gallery as $gallery){
                if($gallery && is_file($gallery)){
                    $gimagename='';
                    $image = $gallery;
                    $gimagename =$detail->slug.time().rand(1000,1).'.'.$image->getClientOriginalExtension();
                    $thumbPath = getcwd().'/storage/app/product/gallery/thumbnails/';
                    $destinationPath = getcwd().'/storage/app/product/gallery/images/';
                    $img = Image::make($image->getRealPath());
                    $img->resize(768, 1024, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($destinationPath.$gimagename);
                    $img->resize(325, 433, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbPath.$gimagename);
                    // $image->move($destinationPath,$gimagename);
                    $galleryimg[]=$gimagename;
                }
            }
        }
        $detail->gallery=json_encode($galleryimg);
        $detail->status=$r->status??1;
        try {
            $detail->save();
            if($r->product && is_array($r->product)){
                foreach($r->product as $k=>$prod){
                    if($k==0){
                      $detail->price=$prod['inr_price'];
                    }
                    if(isset($prod['id']) && $prod['id']){
                        $pd=ProductDetail::find($prod['id']);
                    }else{
                        $pd=new ProductDetail();
                        $pd->product_id=$detail->id;
                    }
                    $pd->color=$prod['colors'];
                    $pd->size=$prod['size'];
                    $pd->quantity=$prod['quantity'];
                    $pd->inr_price=$prod['inr_price'];
                    $pd->inr_sell_price=$prod['inr_sell_price'];
                //    $pd->usd_price=$prod['usd_price'];
                 //   $pd->usd_sell_price=$prod['usd_sell_price'];
                    $pd->save();
                }

            }
            if($isnew){
                $detail->slug=$detail->slug.'-'.$detail->id;
            }
            $detail->save();
            return back()->with('success',$msg);
        } catch (\Exception $e) {
            $msg=$e->getMessage();
            dd($msg);
            return back()->with('error',ServerError);
        }
    }
    public function deleteProduct(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Product::find($r->id);
        if($detail){
            $detail->delete();
            return array('status'=>1,'message'=>Deleted);
        }else{
            return array('status'=>0,'message'=>NotDeleted);
        }
    }
    public function statusProduct(Request $r){
        $validate=Validator::make($r->all(),[
            'id'=>'required|integer',
            'status'=>'required|in:0,1'
        ]);
        if($validate->fails()){
            return array('status'=>0,'message'=>$validate->errors()->first());
        }
        $detail=Product::where('id',$r->id)->update(['status'=>$r->status]);
        if($detail){
            return array('status'=>1,'message'=>StatusUpdate);
        }else{
            return array('status'=>0,'message'=>NotStatusUpdate);
        }
    }

    public function exportProductFormat(Request $request){
        // $categorySub=Category::where('parent_id','!=',0)->get();
        // prd($categorySub);
        return Excel::download(new ProductFormatExport, 'productformatsheet.xlsx');
    }

}
