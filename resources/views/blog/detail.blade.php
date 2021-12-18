@extends($layout)
@section('content')
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
        <div class="container">
            <div class="page-banner-wrap">
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                    <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span itemprop="name">Home</span></a></li>
                    <li class="breadcrumb-item trail-end"><span itemprop="name">Blog Details</span></li>
                </ul>
            </div>      
        </div>
        </div>
        </div>
        </div>
        <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="container">
        <div class="page-header text-center">
            <h1 class="page-title">Blog Details</h1>
        </div>
        <div class="row">
            <div class="content-area col-lg-9 col-12">
                <div class="post-outer">
                    @if ($Blogs)
                        @foreach ($Blogs as $blog)
                        @php
                            # prd($blog);
                            # $out = strlen($blog->description) > 50 ? substr($blog->description,0,50)."..." : $blog->description; 
                             @endphp
                        <div id="blog-1" class="single-blog-item">
                            <div class="single-blog-wrap">
                                <div class="single-blog-image">
                                    <img src="{{$blog->image_url}}" alt="">
                                </div>
                                <div class="single-blog-summery">
                                    <h4 class="single-blog-title">{{$blog->title}}</h4>
                                    <div class="blog-meta">
                                        <span class="blog-labels"><i class="fa fa-tag"></i> <a href="#"
                                                rel="category tag">{{$blog->cat->name}}</a></span>
                                        <span class="blog-author">By Admin</span>
                                        <span class="blog-timestamp"> On @php echo date('d F, Y g:i A', strtotime($blog->created_at)); @endphp</span>
                                    </div>
                                    <div class="single-blog-content">
                                        <p>{{$blog->description}} </p>
                                       
                                    </div>
                                </div>
                                {{-- <div class="blog-share-icon">
                                    <div class="share-title">Share On</div>
                                    <div class="share-icon">
                                        <a class="facebook" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a class="twitter" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a class="whatsapp" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                        <a class="envelope" href="#" target="_blank"><i class="far fa-envelope"></i></a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                            
                        @endforeach
                    @endif             
                    
                    <!--blog-item-->
                </div>
            </div>
            <!--content-area -->
            <div id="sidebar" class="sidebar widget-area col-lg-3 col-12">                
                <div class="widget widget-recent-entries">
                    <h3 class="widget-title">Recent BLogs</h3>
                    @if ($recents)
                    <ul>
                        @foreach ($recents as $item)
                        <li>
                            <a href="{{url('blog/'.$item->slug)}}">{{$item->title}} </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif               
                </div>
                <div class="widget widget-recent-entries">
                    <h3 class="widget-title">Top Category</h3>
                    @if($cats)
                    <ul>
                     @foreach ($cats as $cat)
                     @php
                       
                     @endphp
                        <li>
                            <a href="{{$cat->blog_url}}">{{$cat->name}}</a>
                        </li>
                     @endforeach
                        
                    @endif
                    </ul>                
                </div>
                
            </div>
            <!-- .sidebar .widget-area -->
        </div>
        <!--row-->
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
    </section>
@endsection