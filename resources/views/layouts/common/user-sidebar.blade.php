@php($user=Auth::user())
<div class="sidebar-section col-md-3 col-sm-12 col-12">
  <div class="box-item">
    <div class="box-wrap box-border-bottom box-radius">
      <div class="user-intro box-body">
        <div class="user-icon">  <img src="{{$user->image_url}}" alt="{{$user->name}}"> </div>
        <div class="user-info"> 
        <h4> {{$user->name}}</h4>
        <p>Wallet Balance - <i class="fa fa-rupee"></i> 0.00</p>
        </div>
      </div>
    </div>  
  </div>
  <div class="box-item">
    <div class="box-wrap box-border-bottom box-radius">
      <div class="box-body p-0">
        <ul class="sidebar-account-menu">
          <li class="@if(Request::is('user/dashboard')) active @endif"><a href="{{url('user/dashboard')}}"> <i class="fas fa-user"></i>My Account </a> </li>
          <li class="@if(Request::is('user/address')) active @endif"> <a href="{{url('user/address')}}"> <i class="fas fa-address-book"></i>My Address </a> </li>
          <li class="@if(Request::is('user/order')) active @endif"> <a href="{{url('user/order')}}"> <i class="fas fa-shopping-basket"></i>My Orders </a> </li>
          <li  class="@if(Request::is('user/product/wishlist')) active @endif"> <a href="{{url('user/product/wishlist')}}"> <i class="far fa-heart"></i>My Wishlist </a> </li>
          <li class="@if(Request::is('user/coupon')) active @endif"> <a href="{{url('user/coupon')}}"> <i class="fas fa-tags"></i>My Coupons </a> </li>
          <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
			<a href="{{route('logout')}}" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i>Log out</a>
		    </form>
		   </li>
        </ul>
      </div>
    </div>  
  </div>
</div>