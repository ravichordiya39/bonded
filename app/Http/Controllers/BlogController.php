<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Category;
use App\Models\Blog;
use App\Http\Libs\BlogLib;

class BlogController extends Controller
{
    public function getBlogs(Request $r){
        $data=$filter=$r->all();
        $blib=new BlogLib();
        $filter['status']=1;
        $data['blogs']=$blib->blogList($filter);
        $data['layout']=getLayout();
        return view('blog.list',$data);

    }
    public function getCatBlog(Request $r,$cat){
        $category=Category::where(['slug'=>$cat])->first();
        $data=$filter=$r->all();
        $plib=new BlogLib();
        $filter['status']=1;
        $filter['cat_id']=$category->id;
        $data['blogs']=$plib->BlogList($filter);
        $data['layout']=getLayout();
        return view('blog.list',$data);

        
    }
    public function getSubCatBlog(Request $r,$cat,$scat){
        $data=$filter=$r->all();
        $plib=new BlogLib();
        $data['Blogs']=$plib->BlogList($filter);
        $data['layout']=getLayout();
        return view('Blog.list',$data);

        
    }
    public function getBlogDetail(Request $r,$slug){
        $data=$filter=$r->all();
        $plib=new BlogLib();
        $filter['slug']=$slug;
        $filter['status']=1;
        $data['recents'] = Blog::latest()->get();
        $data['cats'] = Category::take(5)->get();
        $data['Blogs']=$plib->blogList($filter);
        $data['layout']=getLayout();
        return view('blog.detail',$data);

        
    }
}
