@extends($layout)
@section('content')      
<section class="home-site-content">
    <div class="slider-section">
        <div class="slider-carousel">
            @if($banners->count())
            @foreach($banners as $banner)
            <div class="slider-item">
                <div class="slider-images">
                    <img src="{{$banner->image_url}}" />
                </div>
                <div class="slider-summery">
                    <h4 class="slider-heading">{{$banner->heading??'Hand block Printed Designs'}} </h4>
                    @if($banner->description != null)
                    <p class="slider-description">
                    {{$banner->description}}
                    </p> 
                    @endif
                        <!-- 'Selects the given list item and shows its associated pane. Any
                        other list item that was previously selected becomes unselected and its associated pane
                        is hidden. -->
                    <!-- <a href="{{$banner->link??'javascript:;'}}" class="btn btn-primary">Shop Now </a> -->
                </div>
            </div>
            @endforeach
            @else
            <div class="slider-item">
                <div class="slider-images">
                    <img src="{{url('public/front')}}/images/slider-2.jpg" />
                </div>
                <div class="slider-summery">
                    <h4 class="slider-heading">Hand block Printed Designs </h4>
                    <p class="slider-description">Selects the given list item and shows its associated pane. Any
                        other list item that was previously selected becomes unselected and its associated pane
                        is hidden.</p>
                    <a href="#" class="btn btn-primary">Shop Now </a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!--=====================================================
                                  Slider Section End
      =========================================================-->
    <div class="product-category-section section">
        <div class="container-custom">
            <div class="section-header text-center">
                <h2 class="section-title">Shop By Category</h2>
            </div>
            <div class="product-category-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row">
                            @if($cats->count())
                            @foreach($cats as $k=>$cat)
                            @if($k<4)
                            <div class="product-category-item col-lg-6 col-md-6 col-sm-6 col-12 wow animate__animated animate__zoomIn"
                                data-wow-delay="0.4s">
                                <div class="product-category-wrap">
                                    <div class="product-category-image"><a href="{{$cat->url}}">
                                            <img src="{{$cat->image_url}}" alt="{{$cat->name}}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="product-category-item col-lg-6 col-md-6 col-sm-12 col-12 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">      
                        @if(isset($cats[$k]) && $cats[$k])                     
                        <div class="product-category-wrap">
                            <div class="product-category-image"><a href="{{$cats[$k]->url}}">
                                    <img src="{{$cats[$k]->image_url}}" alt="" />
                                </a>
                            </div>                                   
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                     Product Category Section End
     =========================================================-->

    <div class="product-section section">
        <div class="container-custom">
            <div class="product-section-header">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12 d-flex align-items-center">
                        <div class="section-header color-white">
                            <h2 class="section-title">{{$exclusive->heading??'Our Exclusive Product'}} </h2>
                            <p class="section-description">
                                {{$exclusive->description??'Selects the given list item and shows its associated pane. Any other list item
                                that was previously selected becomes unselected and its associated pane is
                                hidden. Returns to the caller before the tab pane has actually been shown (for
                                example, before the shown.bs.tab event occurs).'}}
                            </p>
                            <a class="btn btn-primary mt-4" href="{{url('product/exclusive')}}">Find a Shop </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-section-image">
                            <img src="{{url('public/front')}}/images/slider-1.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="products-wrapper">
                <div class="products-area">
                    <ul class="products product-carousel">
                        @if($hplists->count())
                        @php
                            $cType = checkCurrencySession();
                            $column =$cType['column_name'];
                            $sell_column =$cType['sell_column'];
                        @endphp
                        @foreach($hplists as $list)
                        @php
                        if(isset($list->pDetail->$sell_column) && $list->pDetail->$sell_column){
                                $maxp=$list->pDetail->$column??0;
                                $sellp=$list->pDetail->$sell_column??0;
                            }else{
                                $sellp=$list->pDetail->$column??0;
                            }
                        @endphp
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                    </div>
                                    <a href="{{$list->url}}">
                                        <img src="{{$list->thumbnail_url}}" alt="{{$list->name}}" class="main-image">
                                    </a>
                                    <div class="product-wishlist wishlist">
                                        <a href="javascript:void(0)" rel="{{$list->id}}" data-id="{{$list->id}}" class="add-to-wishlist favourite">
                                                @if(isset($list->wishDetails))
                                                    @if($list->wishDetails->product_id == $list->id)
                                                    <i class="fa fa-heart" id="divcommenttextbox_{{$list->id}}"></i>
                                                    @endif
                                                @else
                                                    <i class="far fa-heart" id="divcommenttextbox_{{$list->id}}"></i>
                                                @endif
                                            </a>
                                    </div>
                                    <div class="product-cart-button">
                                        <a href="javascript:;" data-id="{{$list->id}}" data-pdid="{{$list->pDetail->id}}"  class="add-cart-button">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h5 class="product-title">
                                        <a href="{{$list->url}}">{{$list->name}}</a>
                                    </h5>
                                    <div class="product-price">
                                        <span class="price"><span class="Price-currencySymbol">{{$cType['icon']}}</span>
                                            {{$sellp}}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{url('public/front')}}/images/product-2.jpg" alt="" class="main-image">
                                    </a>
                                    <div class="product-wishlist wishlist">
                                        <a href="#" class="add-to-wishlist">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="product-cart-button">
                                        <a href="#" class="add-cart-button">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h5 class="product-title">
                                        <a href="#">High Quality Cotton Jacquard Satin Four-Piece Bedding Set
                                            Product </a>
                                    </h5>
                                    <div class="product-price">
                                        <span class="price"><span class="Price-currencySymbol">₹</span>
                                            2,200.00</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Product Section End
      =========================================================-->

    <div class="about-section section">
        <div class="container-custom">
            <div class="about-outer">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 pr-lg-4">
                        <div class="about-video-block wow animate__animated animate__fadeInUp"
                            data-wow-delay="0.4s">
                            @if(isset($about->ftype))
                            @if($about->ftype=='youtube' || $about->ftype=='vemeo')
                            <iframe src="{{$about->video_link}}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" width="100%" height="400" frameborder="0"></iframe>
                            @else
                            <img src="{{$about->image_url}}" alt="{{$about->title}}">
                            @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="about-image-block wow animate__animated animate__fadeInUp"
                            data-wow-delay="0.4s">
                            <!-- <div class="about-image">
                                <img src="{{url('public/front')}}/images/about.jpg" alt="">
                            </div> -->
                        </div>
                        <div class="about-content-block wow animate__animated animate__fadeInUp"
                            data-wow-delay="0.4s">
                            <div class="about-content">
                                <h4>{{$about->title??'About Us'}}</h4>
                                <p>@if(isset($about->description))
                                    {!! substr(strip_tags($about->description),0,300) !!}
                                    @else
                                    Somendra Textiles is a private company with deep industry roots and strong
                                    relationships in the field
                                    of Handcrafted Home Textiles. As a manufacturer, exporter, wholesaler, and
                                    trendsetter in home
                                    furnishings the Jaipur (India) based company has registered uninterrupted
                                    growth since the time it was
                                    founded.
                                    @endif
                                </p>
                                <p><a class="about-link" href="{{$about->url??'#'}}">More..</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        About Section End
      =========================================================-->          

    <div class="blocks-section section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Reasons To Snooze With Us</h2>
            </div>
            <div class="row grid-body justify-content-center">
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/10_Yrs_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">UP TO 10 YEARS <br> WARRANTY</div>
                </div>
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/100_trial_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">
                        UP TO 100<br />
                        Nights TRIAL
                    </div>
                </div>
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/flexy_emi_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">
                        NO COST<br />
                        EMI
                    </div>
                </div>
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/human_frndly_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">Planet Human <br> Friendly</div>
                </div>
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/Esy_cod_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">
                        EASY<br />
                        COD
                    </div>
                </div>
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/custom-size_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">
                        CUSTOM<br />
                        SIZES
                    </div>
                </div>
                <div class="block-item col-6 col-md-auto wow animate__animated animate__bounceIn"
                    data-wow-delay="0.4s">
                    <div class="block-icon">
                        <img src="{{url('public/front')}}/images/freeship_320x.gif" alt="#" />
                    </div>
                    <div class="block-description">
                        FREE<br />
                        SHIPPING
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Block Section End
      =========================================================-->

    <div class="instagram-section section">
        <div class="container-fluid">
            <div class="section-header text-center">
                <h2 class="section-title">Instagram Feed</h2>
            </div>
            <div class="instagram-carousel">
                <div class="instagram-item">
                    <div class="instagram-wrap">
                        <a href="#">
                            <div class="instagram-image"><img src="{{url('public/front')}}/images/latestcatgory-4.webp" alt=".."></div>
                            <div class="instagram-overlay">
                                <div class="instagram-overlay-content">
                                    <i class="fa fa-heart"></i>
                                    <span>1.4k</span>
                                    <div class="instragam-text">Shop The Look</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="instagram-item">
                    <div class="instagram-wrap">
                        <a href="#">
                            <div class="instagram-image"><img src="{{url('public/front')}}/images/latestcatgory-5.webp" alt=".."></div>
                            <div class="instagram-overlay">
                                <div class="instagram-overlay-content">
                                    <i class="fa fa-heart"></i>
                                    <span>1.4k</span>
                                    <div class="instragam-text">Shop The Look</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="instagram-item">
                    <div class="instagram-wrap">
                        <a href="#">
                            <div class="instagram-image"><img src="{{url('public/front')}}/images/latestcatgory-6.webp" alt=".."></div>
                            <div class="instagram-overlay">
                                <div class="instagram-overlay-content">
                                    <i class="fa fa-heart"></i>
                                    <span>1.4k</span>
                                    <div class="instragam-text">Shop The Look</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="instagram-item">
                    <div class="instagram-wrap">
                        <a href="#">
                            <div class="instagram-image"><img src="{{url('public/front')}}/images/latestcatgory-7.webp" alt=".."></div>
                            <div class="instagram-overlay">
                                <div class="instagram-overlay-content">
                                    <i class="fa fa-heart"></i>
                                    <span>1.4k</span>
                                    <div class="instragam-text">Shop The Look</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="instagram-item">
                    <div class="instagram-wrap">
                        <a href="#">
                            <div class="instagram-image"><img src="{{url('public/front')}}/images/latestcatgory-4.webp" alt=".."></div>
                            <div class="instagram-overlay">
                                <div class="instagram-overlay-content">
                                    <i class="fa fa-heart"></i>
                                    <span>1.4k</span>
                                    <div class="instragam-text">Shop The Look</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="instagram-item">
                    <div class="instagram-wrap">
                        <a href="#">
                            <div class="instagram-image"><img src="{{url('public/front')}}/images/latestcatgory-6.webp" alt=".."></div>
                            <div class="instagram-overlay">
                                <div class="instagram-overlay-content">
                                    <i class="fa fa-heart"></i>
                                    <span>1.4k</span>
                                    <div class="instragam-text">Shop The Look</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Instagram Section End
      =========================================================-->

</section>
<div class="modal fade newsletter-popup" id="newsletter-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" onclick="closePopup()">&times;</button>
                <div class="modal-body">
                    <div class="onloadmodal text-center">
                        <img src="{{url('public/front')}}/images/messagebox.png">
                        <h3>Brighten <span class="d-block">up your inbox!</span></h3>
                        <p>Get decor tips &amp; Color Manager call you shortly.</p>
                        <form class="newsletter-popup-form">
                            <div class="form-group">
                                <input type="email" placeholder="Your Email Here" class="form-control" name="">
                            </div>
                            <div class="form-btn"><button class="btn btn-primary">Let's do This !</button></div>
                        </form>
                        <div class="social">
                            <ul class="social-icon">
                                <li class="facebook"><a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="instagram"><a target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                                <li class="pinterest"><a target="_blank" href="#"><i class="fab fa-pinterest"></i></a></li>
                                <li class="twitter"><a target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="youtube"><a target="_blank" href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js-script')


<script>
    $(document).ready(function(){
        if(localStorage.getItem('abeerPopup') != 'shown'){
            $('#newsletter-popup').modal({
				   backdrop: 'static',
				   show: true
			   });
           
        }
        
    });
    function closePopup() {
        localStorage.setItem('abeerPopup','shown')
    }
</script>
@endsection

