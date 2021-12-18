<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table='config_size';
    protected $fillable=['name','status','slug','size'];

    public function productCount(){
        return \App\Models\Product\ProductDetail::where(['size'=>$this->id])->count();
    }
}
