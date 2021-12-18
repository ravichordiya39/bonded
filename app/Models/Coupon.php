<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table='coupons';
    protected $fillable=['name','code','type','per_amt','stock_value','count','description','start_date','end_date','coupon_count','coupon_label','coupon_img','status'];
    //

    public function userCoupon()
    {
        return $this->belongsTo(UserCoupon::class);
    }
}
