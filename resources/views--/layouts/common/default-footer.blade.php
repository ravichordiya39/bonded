<footer class="footer-section" id="footer-section">
<div class="footer">
    @php
    $configs=\App\Models\Common\Config::where(['ctype'=>'front','status'=>1])->get();
    $pages=\App\Models\CMS::where(['status'=>1])->get();
    foreach($configs as $config){
        $name=$config->key_name;
        ${$name}=$config;
    }
    foreach($pages as $page){
        $name=$page->ctype;
        ${$name}=$page;
    }
    @endphp
    <div class="footer-top">
        <div class="container-custom">
            <div class="footer-widget-outer">
                <div class="row">
                    <div class="footer-column footer-1 col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn"
                        data-wow-delay="0.3">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <img src="{{url('public/front')}}/images/logo-white.png" alt="..">
                            </div>
                            <div class="textwidget">
                                <p>{{$about_text->key_value??'Somendra Textiles is a private company with deep industry roots and
                                    strong relationships in the field of Handcrafted Home Textiles.'}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer-column footer-2 col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn"
                        data-wow-delay="0.5s">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Company</h4>
                            <div class="menu-about-container">
                                <ul id="menu-about" class="menu">
                                    @if(isset($contact_us))
                                    <li><a href="{{$contact_us->url??'#'}}">Contact Us</a></li>
                                    @endif
                                    @if(isset($about))
                                    <li><a href="{{$about->url??'#'}}">About Us</a></li>
                                    @endif
                                    @if(isset($faq))
                                    <li><a href="{{$faq->url??'#'}}">FAQ</a></li>
                                    @endif
                                    <li><a href="{{url('blog/list')}}">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-column footer-2  col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn"
                        data-wow-delay="0.7s">
                        <div class="footer-widget widget_nav_menu">
                            <h4 class="footer-widget-title">Support</h4>
                            <div class="menu-my-account-container">
                                <ul id="menu-my-account" class="menu">
                                    @if(isset($customer_service))
                                    <li><a href="{{$customer_service->url??'#'}}">Customer Service</a></li>
                                    @endif
                                    @if(isset($how_to_order))
                                    <li><a href="{{$how_to_order->url??'#'}}"> How to Orders</a></li>
                                    @endif
                                    @if(isset($billing))
                                    <li><a href="{{$billing->url??'#'}}"> Billing & Payment</a></li>
                                    @endif
                                    @if(isset($returns))
                                    <li><a href="{{$returns->url??'#'}}">Exchange &#038; Return Policy</a></li>
                                    @endif
                                    @if(isset($privacy))
                                    <li><a href="{{$privacy->url??'#'}}">Privacy Policy</a></li>
                                    @endif
                                    @if(isset($terms))
                                    <li><a href="{{$terms->url??'#'}}">Terms &amp; Conditions</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-column footer-1 col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn"
                        data-wow-delay="0.9s">
                        <div class="footer-widget">
                            <div class="footer-social">
                                <h4 class="footer-widget-title">Follow Us</h4>
                                <ul class="footer-social-icon">
                                    @if(isset($fb_url))
                                    <li class="facebook"><a target="_blank" href="{{$fb_url->key_value??'#'}}"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if(isset($instagram_url))
                                    <li class="instagram"><a target="_blank" href="{{$instagram_url->key_value??'#'}}"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(isset($pinterest_url))
                                    <li class="pinterest"><a target="_blank" href="{{$pinterest_url->key_value??'#'}}"><i class="fab fa-pinterest"></i></a></li>
                                    @endif
                                    @if(isset($twitter_url))
                                    <li class="twitter"><a target="_blank" href="{{$twitter_url->key_value??'#'}}"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if(isset($youtube_url))
                                    <li class="youtube"><a target="_blank" href="{{$youtube_url->key_value??'#'}}"><i class="fab fa-youtube"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="footer-payment-widget footer-widget">
                            <h4 class="footer-widget-title">Payment Options</h4>
                            <div class="">
                                <img src="{{url('public/front')}}/images/card-image.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container-custom">
            <div class="footer-bottom-outer">
                <div class="row">
                    <div class="footer-bottom-left col-md-6 col-sm-12 col-12">
                        <div class="copyright">
                            <p>&copy;{{date('Y')}} Abeer Jaipur. All Rights Reserved. Powered BY : <a href="https://dzoneindia.co.in/" target="_blank">Dzone India</a></p>
                        </div>
                    </div>
                    <div class="footer-bottom-right col-md-6 col-sm-12 col-12">
                        <ul class="footer-menu">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>