<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class UserCoupon extends Model
{
    use HasFactory;
    #protected $appends=['created_at','image_url','url'];

    public function getCreatedAtAttribute($date){
        
        return Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
       
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function isTotal(){
        return  \App\Models\UserCoupon::where(['user_id'=>Auth::id()])->count();
    }
}
