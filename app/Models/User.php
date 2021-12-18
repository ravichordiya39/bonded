<?php

namespace App\Models;

use App\Models\User\ShippingAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'facebook_id',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends=['image_url'];

    public function getImageUrlAttribute(){
        if($this->image){
            return url('storage/app/user/thumbnails').'/'.$this->image;
        }else{
            return url('public/front/images/profile-img.jpg');
        }
        return false;
    }
    public function userCoupon()
    {
        return $this->hasMany(UserCoupon::class);
    }

    public function billingAddress(){
        return $this->hasOne(ShippingAddress::class)->where('add_type','billing');
    }
}
