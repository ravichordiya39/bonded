<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapAttribute extends Model
{
    use HasFactory;

    public function cat(){
        return $this->belongsTo('\App\Models\Product\Category','cat_id');
    }
}
