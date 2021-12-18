<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Subscribe extends Model
{
    use HasFactory;
    protected $fillable = ['email','ip','name'];
    #protected $appends=['created_at','image_url','url'];

}
