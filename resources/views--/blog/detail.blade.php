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
                    <div id="blog-1" class="single-blog-item">
                        <div class="single-blog-wrap">
                            <div class="single-blog-image">
                                <img src="{{url('public/front')}}/images/blog-1.jpg" alt="">
                            </div>
                            <div class="single-blog-summery">
                                <h4 class="single-blog-title">Lorem Ipsum is simply dummy text</h4>
                                <div class="blog-meta">
                                    <span class="blog-labels"><i class="fa fa-tag"></i> <a href="#"
                                            rel="category tag">Textile</a></span>
                                    <span class="blog-author">By Admin</span>
                                    <span class="blog-timestamp"> On Nov 27, 2020</span>
                                </div>
                                <div class="single-blog-content">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                        has been the industry's standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                        has been the industry's standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                        has been the industry's standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type and scrambled it to make a type specimen book. </p>
                                </div>
                            </div>
                            <div class="blog-share-icon">
                                <div class="share-title">Share On</div>
                                <div class="share-icon">
                                    <a class="facebook" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a class="twitter" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a class="whatsapp" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                    <a class="envelope" href="#" target="_blank"><i class="far fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--blog-item-->
                </div>
            </div>
            <!--content-area -->
            <div id="sidebar" class="sidebar widget-area col-lg-3 col-12">                
                <div class="widget widget-recent-entries">
                    <h3 class="widget-title">Recent BLogs</h3>
                    <ul>
                        <li>
                            <a href="#">Fifteen reasons to visit and re-visit Rajasthan </a>
                        </li>
                        <li>
                            <a href="#">Choosing a Software Development Company </a>
                        </li>
                        <li>
                            <a href="#">Lorem Ipsum is simply dummy text</a>
                        </li>
                        <li>
                            <a href="#">Fifteen reasons to visit and re-visit Rajasthan </a>
                        </li>
                        <li>
                            <a href="#">Choosing a Software Development Company </a>
                        </li>
                        <li>
                            <a href="#">Lorem Ipsum is simply dummy text</a>
                        </li>
                        <li>
                            <a href="#">Fifteen reasons to visit and re-visit Rajasthan </a>
                        </li>
                        <li>
                            <a href="#">Choosing a Software Development Company </a>
                        </li>
                        <li>
                            <a href="#">Lorem Ipsum is simply dummy text</a>
                        </li>
                    </ul>                
                </div>
                <div class="widget widget-recent-entries">
                    <h3 class="widget-title">Top Category</h3>
                    <ul>
                        <li>
                            <a href="#">Textile</a>
                        </li>
                        <li>
                            <a href="#">Businnes </a>
                        </li>
                        <li>
                            <a href="#">Latest Products</a>
                        </li>                               
                        <li>
                            <a href="#">Development Company </a>
                        </li>
                        <li>
                            <a href="#">Lorem Ipsum</a>
                        </li>
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