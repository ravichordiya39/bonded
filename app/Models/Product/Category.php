<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
class Category extends Model
{
    use HasFactory;
    protected $appends=['blog_url','thumbnail_url','image_url','url'];

    public function getUrlAttribute(){
        if($this->parent_id){
            return url('product').'/'.$this->cat->slug.'/'.$this->slug;
        }else{
            return url('product').'/'.$this->slug;
        }
        return false;
    }
    
     public function getBlogUrlAttribute(){
        if($this->parent_id){
            return url('blog').'/'.$this->cat->slug.'/'.$this->slug;
        }else{
            return url('blog').'/'.$this->slug;
        }
        return false;
    }
    
    public function getThumbnailUrlAttribute(){
        if($this->cat_image){
            return url('storage/app/category/thumbnails').'/'.$this->cat_image;
        }
        return false;
    }
    public function getImageUrlAttribute(){
        if($this->cat_image){
            return url('storage/app/category/images').'/'.$this->cat_image;
        }
        return false;
    }
    public function scat(){
        return $this->hasMany($this,'parent_id');
    }
    public function cat(){
        return $this->belongsTo($this,'parent_id','id');
    }
    public function productCount(){
        return \App\Models\Product::where(['status'=>1,'cat_id'=>$this->id])->count();
    }
    public function getAllChildren ()
    {
        $sections = new Collection();

        foreach ($this->children as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }

        return $sections;
    }
}
