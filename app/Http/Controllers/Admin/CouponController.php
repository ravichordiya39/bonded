<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Auth;
class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'code' => 'required',
                'type' => 'required',
                'per_amt' => 'required',
                'stock_value' => 'required',
                'coupon_img' => 'image|mimes:JPEG,jpeg,PNG,JPG,png,jpg|max:2048'
            ]
        );

        $data                   = new Coupon;
        $data->coupon_label     = $request->coupon_label;
        $data->name             = $request->name;
        $data->code             = $request->code;
        $data->type             = $request->type;
        $data->per_amt          = $request->per_amt;
        $data->stock_value      = $request->stock_value;
        $data->coupon_count     = $request->coupon_count;
        $data->description      = $request->description;
        $data->end_date      = $request->end_date;
        if($request->hasfile('coupon_img'))
         {
            $image = $request->file('coupon_img');
            $coupon_img = $image->getClientOriginalName();
            $path = 'storage/coupon/';
            $upload = $image->move($path, $coupon_img); 
            $data->coupon_img = $coupon_img;
         }
        $data->save();
        return redirect('admin/coupon')->with('flash_message', 'Coupon Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact('coupon'));
    }


    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'code' => 'required',
                'type' => 'required',
                'per_amt' => 'required',
                'stock_value' => 'required',
                'coupon_img' => 'image|mimes:JPEG,jpeg,PNG,JPG,png,jpg|max:2048'
            ]
        );

        $data                   = Coupon::find($id);
        $data->coupon_label     = $request->coupon_label;
        $data->name             = $request->name;
        $data->code             = $request->code;
        $data->type             = $request->type;
        $data->per_amt          = $request->per_amt;
        $data->stock_value      = $request->stock_value;
        $data->coupon_count     = $request->coupon_count;
        $data->description      = $request->description;
        $data->end_date      = $request->end_date;
        if($request->hasfile('coupon_img'))
         {
            $image = $request->file('coupon_img');
            $coupon_img = $image->getClientOriginalName();
            $path = 'storage/coupon/';
            $upload = $image->move($path, $coupon_img); 
            $data->coupon_img = $coupon_img;
         }
        $data->update();
        return redirect('admin/coupon')->with('flash_message', 'Coupon Added Successfully.');
    }


    public function destroy($id)
    {
        $data  = Coupon::find($id);
        $data->delete();
         return redirect()->back()->with('flash_message', 'Coupon Deleted Successfully.');
    }

    public function couponStatus(Request $request)
    {
        $id = $request->id;
        $data = Coupon::find($id);
        if($data->status=='1')
        {
            $data->status = '0';
        }
        else
        {
            $data->status = '1';
        }
        $data->update();
    }
}
