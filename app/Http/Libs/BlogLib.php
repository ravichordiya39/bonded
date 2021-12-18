<?php

namespace App\Http\Libs;

use Illuminate\Http\Request;

use App\Models\Product\Category;
use App\Models\Blog;

class BlogLib{

	public function blogList($filter){
		if(!isset($filter['paginate'])){
			$filter['paginate']=Paginate;
		}
		$list=Blog::where(function($query) use ($filter){
			if(isset($filter['slug']) && $filter['slug']){
				$query->where('slug',$filter['slug']);
			}
			if(isset($filter['cat_id']) && $filter['cat_id']){
				$query->where('cat_id',$filter['cat_id']);
			}
			if(isset($filter['status'])){
				$query->where('status',$filter['status']);
			}
		})->paginate($filter['paginate']);
		return $list;
	}

}