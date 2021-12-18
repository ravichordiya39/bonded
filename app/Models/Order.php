<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['order_id','status','discount_name','discount','p_price'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function shippingAddress(){
        return $this->belongsTo('App\Models\User\ShippingAddress','shipping_address_id');
    }
    public function billingAddress(){
        return $this->belongsTo('App\Models\User\ShippingAddress','shipping_address_id')->where('add_type','billing');
    }
    public function pDetail(){
        return $this->belongsTo('App\Models\Product\ProductDetail','product_detail_id');
    }

    public function orderDetails(){
        return $this->hasMany($this,'parent_id');
    }
    public function orders(){
        return $this->belongsTo($this,'parent_id','id');
    }
}
