@php
	$cartitem=0;
	if(Session::has('PCart')){
		$cart = Session::get('PCart');
		if(isset($cart['product'])){
      $cartitem=count($cart['product']);
    }
	}
	@endphp
	 <a href="@if($cartitem){{url('view-cart')}}@else javascript:void(0) @endif" title="View your shopping cart" class="cart-contents">
		<span class="cart-icon">
		  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
			xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.997 511.997"
			style="enable-background:new 0 0 511.997 511.997;" xml:space="preserve">
			<g>
			  <g>
				<path d="M405.387,362.612c-35.202,0-63.84,28.639-63.84,63.84s28.639,63.84,63.84,63.84s63.84-28.639,63.84-63.84
						S440.588,362.612,405.387,362.612z M405.387,451.988c-14.083,0-25.536-11.453-25.536-25.536s11.453-25.536,25.536-25.536
						c14.083,0,25.536,11.453,25.536,25.536S419.47,451.988,405.387,451.988z" />
			  </g>
			</g>
			<g>
			  <g>
				<path
				  d="M507.927,115.875c-3.626-4.641-9.187-7.348-15.079-7.348H118.22l-17.237-72.12c-2.062-8.618-9.768-14.702-18.629-14.702
					H19.152C8.574,21.704,0,30.278,0,40.856s8.574,19.152,19.152,19.152h48.085l62.244,260.443
					c2.062,8.625,9.768,14.702,18.629,14.702h298.135c8.804,0,16.477-6.001,18.59-14.543l46.604-188.329
					C512.849,126.562,511.553,120.516,507.927,115.875z M431.261,296.85H163.227l-35.853-150.019h341.003L431.261,296.85z" />
			  </g>
			</g>
			<g>
			  <g>
				<path d="M173.646,362.612c-35.202,0-63.84,28.639-63.84,63.84s28.639,63.84,63.84,63.84s63.84-28.639,63.84-63.84
				S208.847,362.612,173.646,362.612z M173.646,451.988c-14.083,0-25.536-11.453-25.536-25.536s11.453-25.536,25.536-25.536
				s25.536,11.453,25.536,25.536S187.729,451.988,173.646,451.988z" />
			  </g>
			</g>
		  </svg>
		  <span class="cart-count cart-number-items" >
			@if($cartitem)
			{{$cartitem}}
		@else
			0
		@endif
			
		  </span></span>
	  </a>



	  @if(Session::has('PCart') && $cartitem !=0)
	  <div class="cart-dropdown">
		<div class="widget-shopping-cart">
		  <div class="widget-shopping-cart-content">
			<ul class="mini-cart">
				@php
				 $price=0;
				$total=0;
				$shipping=0;
				$tax=0;
				$cart = Session::get('PCart');
			
				@endphp
			@foreach($cart['product'] as $key=>$pd) 
				@php
				$pd = (object) $pd;
					
				$maxp=$sellp=$gst=0;
				if(isset($pd->inr_sell_price) && $pd->inr_sell_price){
					$maxp=$pd->inr_price??0;
					$sellp=$pd->inr_sell_price??0;
				}else{
					$sellp=$pd->inr_price??0;
				}
				$gst=$pd->gst??0;
				$nsellPrice = $sellp*$pd->qty;
				$price+= $nsellPrice;
			@endphp
			  <li class="mini-cart-item">
				<a href="#" class="remove remove_from_cart_button" aria-label="Remove this item"
				  data-product_id="{{$key}}">×</a>
				  <a href="{{$pd->url??'javascript:;'}}">
					<img src="{{$pd->thumbnail_url??''}}">{{$pd->pname??''}}</a>
				<span class="quantity">{{$pd->qty}} × <span class="mini-cart-price"><span
					  class="Price-amount amount"><span class="Price-currencySymbol">₹</span>
					  {{$sellp}}</span></span></span>
			  </li>
			  @endforeach
			</ul>
			<p class="mini-cart-total">
			  <strong>Subtotal:</strong> <span class="mini-cart-price"><span
				  class="Price-amount amount"><span class="Price-currencySymbol">₹</span>
				 {{$price}}</span></span>
			</p>
			<p class="mini-cart-buttons">
			  <a href="{{url('view-cart')}}" class="button">View cart</a>
			  <a href="{{url('view-cart')}}" class="button checkout">Checkout</a>
			</p>
		  </div>
		</div>
	  </div>
	  @endif
    
