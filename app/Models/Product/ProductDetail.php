<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','color','size','quantity','inr_price','inr_sell_price','usd_price','usd_sell_price'];
    public function sizeDetail(){
        return $this->belongsTo('\App\Models\Product\Size','size');
    }
     public function colorDetail(){
        return $this->belongsTo('\App\Models\Product\Color','color');
    }
    public function sizeDetails(){
        return $this->belongsTo('\App\Models\Product\Size','size');
    }
    public function productSizeCount(){
        return \App\Models\Product\Size::where(['id'=>$this->id])->count();
    }
}
