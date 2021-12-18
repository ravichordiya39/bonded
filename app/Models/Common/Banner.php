<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $appends=['thumbnail_url','image_url'];

    public function getThumbnailUrlAttribute(){
        if($this->image){
            return url('storage/app/banner/thumbnails').'/'.$this->image;
        }
        return false;
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return url('storage/app/banner/images').'/'.$this->image;
        }
        return false;
    }
}
