<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','cat_id','scat_id','name','slug','sku','hsn_code',
    'gst','image','gallery','price	','description','p_description','shipping','details','is_home','is_exclusive','status'];
    
    protected $appends=['thumbnail_url','image_url','url'];
    
    public function getUrlAttribute(){
        if($this->slug){
            return url('product/detail').'/'.$this->slug;
        }
        return false;
    }

    public function getThumbnailUrlAttribute(){
        if($this->image){
            return url('storage/app/product/thumbnails').'/'.$this->image;
        }
        return false;
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return url('storage/app/product/images/').'/'.$this->image;
        }
        return false;
    }
    public function cat(){
        return $this->belongsTo('\App\Models\Product\Category','cat_id')->where('parent_id',0);
    }
    public function scat(){
        return $this->belongsTo('\App\Models\Product\Category','scat_id')->where('parent_id','!=',0);
    }
    public function pDetail(){
        return $this->hasOne('\App\Models\Product\ProductDetail','product_id')->where('status',1);
    }
    public function pDetails(){
        return $this->hasMany('\App\Models\Product\ProductDetail','product_id','id')->where('status',1);
    }
    public function wishDetails(){
        return $this->hasOne('\App\Models\Product\ProductBookmark','product_id','id');
    }
    public function isWished(){
        return \App\Models\Product\ProductBookmark::where(['user_id'=>Auth::id(),'product_id'=>$this->id,'status'=>1])->count();
    }
}
