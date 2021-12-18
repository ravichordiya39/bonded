<?php

namespace App\Http\Libs;

use Illuminate\Http\Request;

use App\Models\Product\Category;
use App\Models\Product;
use App\Models\Product\ProductDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductLib{

	public function productList($filter){
		if(!isset($filter['paginate'])){
			$filter['paginate']=Paginate;
		}

		

		if(!isset($filter['sortby'])){
		    if(isset($_GET['orderby'])){
		        $oarr = explode(",", $_GET['orderby']);
                $filter['sortby']= $oarr[0];
		    }
		    else{
			$filter['sortby']='id';
		    }
		}
		if(!isset($filter['sorttype'])){
		    if(isset($_GET['orderby'])){
		        $oarr = explode(",", $_GET['orderby']);
                $filter['sorttype']= $oarr[1];
		    }
		    else{
			$filter['sorttype']='desc';
		    }
		  }
		  DB::enableQueryLog();
		$list=Product::with('pDetails')->with('pDetail')->with(["wishDetails" => function ($q) use ($filter) {
				$q->where('user_id', $filter['ajax']['wish']);
			}])->where(function($query) use ($filter){
				if(isset($filter['search']) && $filter['search']){
					$query->where('name','like', '%'.$filter['search'].'%');
				}
				if(isset($filter['cat_id']) && $filter['cat_id']){
					$query->where('cat_id',$filter['cat_id']);
				}
				if(isset($filter['scat_id']) && $filter['scat_id']){
					$query->where('scat_id',$filter['scat_id']);
				}
				if(isset($filter['is_exclusive']) && $filter['is_exclusive']){
					$query->where('is_exclusive',$filter['is_exclusive']);
				}
				if(isset($filter['status'])){
					$query->where('status',$filter['status']);
				}
				
				if(isset($filter['ajax']['color'])){
					$query->WhereHas("pDetails", function ($s) use ($filter) {
						$s->whereIn('color',$filter['ajax']['color']);
					});
				}
				if(isset($filter['ajax']['size'])){
					$query->WhereHas("pDetails", function ($s) use ($filter) {
						$s->whereIn('size',$filter['ajax']['size']);
					});
				}
				if(isset($filter['ajax']['price'])){
					$query->WhereHas("pDetails", function ($s) use ($filter) {
						$s->where('inr_sell_price', '>=', intval($filter['ajax']['price']));
						$s->where('inr_sell_price', '<=', intval($filter['ajax']['priceMax']));
					});
				}
		})->orderBy($filter['sortby'],$filter['sorttype'])->paginate($filter['paginate']);
		return $list;
	}

}