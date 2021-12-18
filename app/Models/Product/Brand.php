<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table='config_brand';
    protected $appends=['thumbnail_url'];

    public function getThumbnailUrlAttribute(){
        if($this->logo){
            return url('storage/app/brand/thumbnails').'/'.$this->logo;
        }
        return false;
    }
}
