<div class="scroll-top">
    <a class="scroll-to-top" href="javascript:void(0);" id="scrolltop"><i class="fa fa-angle-up"></i></a>
</div>
<div id="loader" class="loader"></div>
<div class="whatsapp-call">
    <div class="d-none d-md-block">
        <a target="_blank" href="https://web.whatsapp.com/send?phone=+91123456789&amp;text=Hi, I had some queries." class="whatsapp"> <i class="fab fa-whatsapp"></i></a>
    </div>
    <div class="d-md-none">
        <a target="_blank" href="https://api.whatsapp.com/send?phone=+91123456789&amp;text=Hi, I had some queries." class="whatsapp"> <i class="fab fa-whatsapp"></i> </a>
    </div>
</div>
    <!-- <div class="modal fade newsletter-popup" id="newsletter-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
    </div> -->
    <!--newsletter-popup-->
    <div class="modal fade loginregister-modal" id="loginregister" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="row">
                        <div class="modal-left-column pr-md-0 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="modal-left-wrap">
                                <div class="modal-login">
                                    <div class="modal-left-header">
                                        <h3>Welcome</h3>
                                        <p>Enter your email address to sign in.</p>
                                    </div>
                                    <form method="POST" action="{{ url('user/login') }}">
           	 						@csrf
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input  class="form-control" id="password"  type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                        	@if (Route::has('password.request'))
							                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
							                        {{ __('Forgot your password?') }}
							                    </a>
							                @endif
                                           <!--  <a href="forget-password.html" class="forgot-pass">Forgot Password?</a> -->
                                        </div>
                                        <div class="form-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                    <div class="login-social">
                                        <strong>- OR SIGN IN USING -</strong>
                                        <div class="social">
                                            <ul class="social-icon">
                                                <li class="facebook"><a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li class="google"><a target="_blank" href="#"><i class="fab fa-google"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="loginregister-now">
                                        <h4>New to Abeer ?</h4>
                                        <a href="#" class="account-link register">Sign Up?</a>
                                    </div>
                                </div>
                                <div class="modal-register d-none">
                                    <div class="modal-left-header">
                                        <h3>Signup</h3>
                                        <p>Create an account to latest Update.</p>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}">
            						@csrf
            						<input type="hidden" name="user_type" value="user">
                                        <div class="form-group">
                                          <label for="name">Name</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                        </div>                                           
                                        <div class="form-group">
                                          <label for="email">Email address</label>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                          <label for="phone_number">Phone Number</label>
                                          <input type="tel" class="form-control" id="phone" name="phone"  placeholder="Phone Number">
                                        </div>
                                        <div class="form-group">
                                          <label for="password">Password</label>
                                          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                        </div>                                         <div class="form-group">
                                          <label for="password">Confirm Password</label>
                                          <input type="password" type="password"
                                			name="password_confirmation" required class="form-control" id="password" placeholder="Password">
                                        </div>          
                                        <div class="form-submit">
                                          <button type="submit" class="btn btn-primary">Create an account</button>
                                        </div>
                                      </form>  
                                      <div class="login-social">
                                        <strong>- OR SIGNUP IN USING -</strong>
                                        <div class="social">
                                            <ul class="social-icon">
                                                <li class="facebook"><a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li class="google"><a target="_blank" href="#"><i class="fab fa-google"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>                                     
                                    <div class="loginregister-now">
                                        <h4>Already have an account?</h4>
                                        <a href="#" class="account-link login">Sign in?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-right-column pl-md-0 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="modal-right-wrap">
                                <div class="modal-side-img">
                                    <img src="{{url('public/front')}}/images/popup-side-img.jpg" alt="">
                                </div>
                                <div class="modal-image-wrapper">
                                    <img src="{{url('public/front')}}/images/logo.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->