<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=['user_id','status','product_id','product_detail_id','quantity','currency'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function pDetail(){
        return $this->belongsTo('App\Models\Product\ProductDetail','product_detail_id');
    }
}
