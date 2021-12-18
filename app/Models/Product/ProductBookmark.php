<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBookmark extends Model
{
    use HasFactory;
    protected $fillable=['product_id','user_id','status','visitor_ip'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
