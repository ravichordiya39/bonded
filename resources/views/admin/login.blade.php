<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<title>Bonded Coir Online: Admin Panel</title>
<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
 
	<script src="{{url('public/admin/js/jquery.min.js')}}"></script>
	<!--<link rel="icon" type="image/x-icon" href="{{url('/public/admin/img/logo.png')}}"/>-->
	<!--<link rel="icon" href="{{url('/public/admin/img/logo.png')}}" type="image/png" sizes="16x16">-->
	
	<link rel="icon" type="image/x-icon" href="https://bonded-coir.com/frontend/webimages/logo.png"/>
	<link rel="icon" href="https://bonded-coir.com/frontend/webimages/logo.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" href="{{url('public/admin/css')}}/pace.css">
	<script src="{{url('public/admin/js/pace.min.js')}}"></script>
	<!--vendors-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{url('public/admin/css/bootstrap-datepicker3.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/admin/css/jquery.scrollbar.css')}}">
	<link rel="stylesheet" href="{{url('public/admin/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{url('public/admin/css/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{url('public/admin/css/daterangepicker.css')}}">
	<link rel="stylesheet" href="{{url('public/admin/css/bootstrap-timepicker.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
	<link rel="stylesheet" href="{{url('public/admin/css/jost.css')}}">
	<!--Material Icons-->
	
	<link rel="stylesheet" type="text/css" href="{{url('public/admin/css/materialdesignicons.min.css')}}">
	<!--Bootstrap + atmos Admin CSS-->
	<link rel="stylesheet" type="text/css" href="{{url('public/admin/css/atmos.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/admin/css/custom.css')}}">
<!-- Additional library for page -->

</head>
<body class="jumbo-page">

<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <p>
                                <img src="https://bonded-coir.com/frontend/webimages/logo.png" width="200" alt="">

                            </p>
                            
                        </div>
                        <h3 class="text-center p-b-20 fw-400">Admin Login</h3>
                       <form method="POST" action="{{ url('admin/login') }}">
                        @csrf
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>

                        </form>
                        <!-- <p class="text-right p-t-10">
                            <a href="#!" class="text-underline">Forgot Password?</a>
                        </p> -->
                    </div>

                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('{{url('public/admin/img/login.svg')}}');">

            </div>
        </div>
    </div>
</main>

<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                    <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                    <div class="container-fluid">
                        <div class="col-md-10 p-t-10 m-auto">
                            <input type="search" placeholder="Search Something"
                                   class=" search form-control form-control-lg">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                        results
                    </div>
                    <div class="list-group list  ">


                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="{{url('/')}}/public/admin/img/users/user-3.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Eric Chen</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="{{url('/')}}/public/admin/img/users/user-4.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Sean Valdez</div>
                                <div class="text-muted">Marketing</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="{{url('/')}}/public/admin/img/users/user-8.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Marie Arnold</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">SRS Document</div>
                                <div class="text-muted">25.5 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">Design Guide.pdf</div>
                                <div class="text-muted">9 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm  ">
                                        <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">response.json</div>
                                <div class="text-muted">15 Kb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">June Accounts.xls</div>
                                <div class="text-muted">6 Mb</div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script src="{{url('public/admin/js')}}/jquery.min.js"></script>
<script src="{{url('public/admin/js')}}/jquery-ui.min.js"></script>
<script src="{{url('public/admin/js')}}/popper.js"></script>
<script src="{{url('public/admin/js')}}//bootstrap.min.js"></script>
<script src="{{url('public/admin/js')}}/select2.full.min.js"></script>
<script src="{{url('public/admin/js')}}/jquery.scrollbar.min.js"></script>
<script src="{{url('public/admin/js')}}/listjs.min.js"></script>
<script src="{{url('public/admin/js')}}/moment.min.js"></script>
<script src="{{url('public/admin/js')}}/daterangepicker.js"></script>
<script src="{{url('public/admin/js')}}//bootstrap-datepicker.min.js"></script>
<script src="{{url('public/admin/js')}}//bootstrap-notify.min.js"></script>
<script src="{{url('public/admin/js')}}/atmos.min.js"></script>
<!--page specific scripts for demo-->


</body>
</html>