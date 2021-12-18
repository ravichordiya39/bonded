<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $appends=['thumbnail_url','image_url'];

    public function getThumbnailUrlAttribute(){
        if($this->image){
            return url('storage/app/blogs/thumbnails').'/'.$this->image;
        }
        return false;
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return url('storage/app/blogs/images/').'/'.$this->image;
        }
        return false;
    }
    public function cat(){
        return $this->belongsTo('\App\Models\Product\Category','cat_id')->where('parent_id',0);
    }
    public function scat(){
        return $this->belongsTo('\App\Models\Product\Category','scat_id')->where('parent_id','!=',0);
    }
}
