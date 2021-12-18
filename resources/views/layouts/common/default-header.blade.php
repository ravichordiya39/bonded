<header class="header-section">
	@php
	$cats=\App\Models\Product\Category::where(['is_menu'=>1,'status'=>1])->take(8)->get();
	$cartitem=0;
	if(Session::has('PCart')){
		$cart = Session::get('PCart');
		if(isset($cart['product'])){
      $cartitem=count($cart['product']);
    }
	}
	@endphp
	<div class="header sticky">
	    <div class="header-announcement">
	      <div class="header-announcement-carousel">
	        <p class="announcement-item"><a href="#">Shipping Flat $30 for all International Orders - Explore</a></p>
	        <p class="announcement-item"><a href="#">Wild Iris & Himalayan Poppy - Dinnerware Collection - Shop Now</a>
	        </p>
	      </div>
	    </div>
	    <div class="header-outer header-sticky">
	      <div class="container-fluid">
	        <div class="header-row">
	          <div class="header-logo">
	            <a class="logo-link" href="{{url('/')}}"><img class="logo" src="{{url('public/front')}}/images/logo.png" alt="logo"></a>
	          </div>
	          <div class="header-menu navbar-expand-xl">
	            <nav class="nav-menu">
	              <div id="navbar" class="collapse navbar-collapse">
	                <ul class="navbar-nav">
	                  <li class="current-menu-item"> <a href="{{url('/')}}">Home</a></li>
	                  <li class="has-children"><a href="#">Shop</a>
                          <div class="mega-menu">
                             <div class="mega-menu-limit">
                               <div class="mega-menu-columns">
                                 @foreach($cats as $cat)
                                 <div class="mega-menu-column">
                                   <h4 class="mega-menu-title"><a href="{{$cat->url}}">{{$cat->name}}</a></h4>
                                   @if($cat->scat)
                                   <ul class="mega-menu-item">
                                     @foreach($cat->scat as $scat)
                                     <li><a href="{{$scat->url}}">{{$scat->name}}</a></li>
                                     @endforeach
                                   </ul>
                                   @endif
                                 </div>
                                 @endforeach
                               </div>
                             </div>
                           </div>
                          </li>

                    <li><a href="{{url('blog')}}"> Blog</a></li>

	                  <!-- <li><a href="about.html"> About Us</a></li> -->
	                  <li><a href="#"> TRACK ORDER</a></li>

	                </ul>
	              </div>
	            </nav>
	          </div>
	          <div class="header-shop-menu navbar-expand-xl navbar-light">
	            <ul class="header-shop-link">
	              <li class="d-none d-md-block">
	                <div class="header-currency">
	                  <form method="post" action="" class="currency-switcher-form">
	                    <input type="hidden" name="currency-switcher" value="INR">
	                    <select name="currency-switcher" data-width="100%" class="currency-switcher"
	                      onchange="woocs_redirect(this.value); void(0);">
	                      <option class="USD" value="USD">$ USD</option>
	                      <option class="INR" value="INR" selected="selected">₹ INR</option>
	                    </select>
	                  </form>
	                </div>
	              </li>
	              <li><a class="search-icon" href="javascript:void(0);">
	                  <span class="shop-icon"><svg class="desktop-icon" viewBox="-3 -3 23 23" version="1.1"
	                      xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	                      <g stroke-width="2">
	                        <polygon
	                          points="18.7071068 17.2928932 17.2928932 18.7071068 12.7628932 14.1771068 14.1771068 12.7628932">
	                        </polygon>
	                        <path
	                          d="M8,16 C3.581722,16 0,12.418278 0,8 C0,3.581722 3.581722,0 8,0 C12.418278,0 16,3.581722 16,8 C16,12.418278 12.418278,16 8,16 Z M8,14 C11.3137085,14 14,11.3137085 14,8 C14,4.6862915 11.3137085,2 8,2 C4.6862915,2 2,4.6862915 2,8 C2,11.3137085 4.6862915,14 8,14 Z">
	                        </path>
	                      </g>
	                    </svg>
	                  </span>
	                </a>
	                <div class="search-wrapper"> <a href="javascript:void(0);" class="search-cancel">Cancel</a>
	                  <div class="searchForm">
	                    <form action="#" method="get">
	                      <input type="search" name="s" class="serach-input" id="productSearch" placeholder="Search Products">
	                      <button class="btn btn-primary searchicon" type="submit"><i class="fa fa-search"></i></button>
						  	<ul class="suggestions" id="listingSerching">
                  			</ul>
	                    </form>
	                  </div>
	                </div>
	              </li>
	              <li class="acoount-icon dropdown">
	                <a class="account-toggle" href="javascript:void(0);" data-toggle="modal" data-target="#loginregister">
	                  <span class="shop-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
	                      xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
	                      style="enable-background:new 0 0 512 512;" xml:space="preserve">
	                      <g>
	                        <g>
	                          <path
	                            d="M256,288.389c-153.837,0-238.56,72.776-238.56,204.925c0,10.321,8.365,18.686,18.686,18.686h439.747 c10.321,0,18.686-8.365,18.686-18.686C494.56,361.172,409.837,288.389,256,288.389z M55.492,474.628 c7.35-98.806,74.713-148.866,200.508-148.866s193.159,50.06,200.515,148.866H55.492z" />
	                        </g>
	                      </g>
	                      <g>
	                        <g>
	                          <path
	                            d="M256,0c-70.665,0-123.951,54.358-123.951,126.437c0,74.19,55.604,134.54,123.951,134.54s123.951-60.35,123.951-134.534 C379.951,54.358,326.665,0,256,0z M256,223.611c-47.743,0-86.579-43.589-86.579-97.168c0-51.611,36.413-89.071,86.579-89.071 c49.363,0,86.579,38.288,86.579,89.071C342.579,180.022,303.743,223.611,256,223.611z" />
	                        </g>
	                      </g>
	                    </svg></span>
	                </a>
	              </li>

	              <li class="shoping-icon d-none d-md-block">
	                <a href="javascript:void(0)" data-toggle="modal" data-target="#loginregister" class="">
	                  <span class="shop-icon"><svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
	                      <path
	                        d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0" />
	                    </svg><span class="shop-number wishlist-number ">0</span></span> </a>
	              </li>
	              <li class="cart-menu dropdown" id="cart-total" >
					@include('layouts.common.header-cart')
	                <!-- <div class="cart-dropdown">
	                  <div class="widget-shopping-cart">
	                    <div class="widget-shopping-cart-content">
	                      <ul class="mini-cart">
	                        <li class="mini-cart-item">
	                          <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item"
	                            data-product_id="1876">×</a>
	                          <a href="#"><img src="{{url('public/front')}}/images/product-3.jpg" alt="">Malti Cushion Cover Set of Two
	                            -Reversible </a>
	                          <span class="quantity">1 × <span class="mini-cart-price"><span
	                                class="Price-amount amount"><span class="Price-currencySymbol">₹</span>
	                                2,200.00</span></span></span>
	                        </li>
	                        <li class="mini-cart-item">
	                          <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item"
	                            data-product_id="1876">×</a>
	                          <a href="#"><img src="{{url('public/front')}}/images/product-3.jpg" alt="">Malti Cushion Cover Set of Two
	                            -Reversible </a>
	                          <span class="quantity">1 × <span class="mini-cart-price"><span
	                                class="Price-amount amount"><span class="Price-currencySymbol">₹</span>
	                                2,200.00</span></span></span>
	                        </li>
	                      </ul>
	                      <p class="mini-cart-total">
	                        <strong>Subtotal:</strong> <span class="mini-cart-price"><span
	                            class="Price-amount amount"><span class="Price-currencySymbol">₹</span>
	                            2,200.00</span></span>
	                      </p>
	                      <p class="mini-cart-buttons">
	                        <a href="cart.html" class="button">View cart</a>
	                        <a href="checkout.html" class="button checkout">Checkout</a>
	                      </p>
	                    </div>
	                  </div>
	                </div> -->
	              </li>
	            </ul>
	            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
	                <span class="menu-bar-one"></span> <span class="menu-bar-two"></span> <span class="menu-bar-three"></span>
	              </button>
	          </div>
	        </div>
	      </div>
	    </div>
  	</div>
</header>
