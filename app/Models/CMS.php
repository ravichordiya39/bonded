<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    use HasFactory;
    protected $table='cms';
    protected $appends=['thumbnail_url','image_url','url'];

    public function getUrlAttribute(){
        if($this->slug){
            return url('page').'/'.$this->slug;
        }
        return false;
    }
    public function getThumbnailUrlAttribute(){
        if($this->image){
            return url('storage/app/cms/thumbnails').'/'.$this->image;
        }
        return false;
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return url('storage/app/cms/images/').'/'.$this->image;
        }
        return false;
    }
}
