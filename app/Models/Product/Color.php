<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table='config_color';
    protected $fillable=['name','status','slug','color_code'];

    public function productCount(){
        return \App\Models\Product\ProductDetail::where(['color'=>$this->id])->count();
    }
}
