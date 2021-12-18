@extends($layout)
@section('content')
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
        <div class="container">
            <div class="page-banner-wrap">
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                    <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span itemprop="name">Home</span></a></li>
                    <li class="breadcrumb-item trail-end"><span itemprop="name">Blog</span></li>
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
            <h1 class="page-title">Blog</h1>
        </div>
        <div class="row">
            <div class="content-area col-12">
                <div class="content-section">
                    <div class="blog-list">
                        <div class="row">
                            @if($blogs)
                             @foreach ($blogs as $blog)
                             @php
                             #prd($blog);
                            # $out = strlen($blog->description) > 50 ? substr($blog->description,0,50)."..." : $blog->description; 
                             @endphp
                             <div id="blog-1" class="blog-item col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="blog-wrap">
                                    <div class="blog-image">
                                        <a href="{{url('blog/details/'.$blog->slug)}}">
                                            <img src="{{$blog->thumbnail_url}}" alt="">
                                        </a>
                                    </div>
                                    <div class="blog-summery">
                                        <h4 class="blog-title"><a href="{{url('blog/details/'.$blog->slug)}}">{{$blog->title}}</a></h4>
                                        <div class="blog-meta">
                                            <span class="blog-labels"><i class="fa fa-tag"></i> <a href="{{$blog->cat->url}}" rel="category tag">{{$blog->cat->name}}</a></span>
                                            <span class="blog-author">By Admin</span>
                                            <span class="blog-timestamp"> On @php echo date('d F, Y g:i A', strtotime($blog->created_at)); @endphp</span>
                                        </div>
                                        <div class="blog-content">
                                            <p>{!! Str::limit($blog->description, 300, '...') !!}</p>
                                        </div>
                                        {{link_to('blog/details/' . ($blog->slug), "Read More"),['class' => "blog-more-link" ]}}
                                        {{-- <div class="blog-share-icon">
                                            <div class="share-title">Share On</div>                                                
                                            <div class="share-icon">
                                                <a class="facebook" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                                <a class="twitter" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                                <a class="whatsapp" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                <a class="envelope" href="#" target="_blank"><i class="far fa-envelope"></i></a>
                                            </div>
                                        </div>   --}}
                                    </div>                                                 
                                </div>
                            </div>
                             @endforeach
                            @endif
                            
                            <!-- blog-item -->
                            
                            <!-- blog-item -->
                                                             
                        </div>
                        <div class="pagination">
                            {{ $blogs->links('pagination::bootstrap-4') }}
                            
                        </div>
                        <!-- pagination -->
                    </div>   
                </div>
            </div>
            <!--content-area-->
        </div>
        <!--row-->
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
    </section>
@endsection