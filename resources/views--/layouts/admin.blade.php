<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="siteurl" id="siteurl" content="{{url('/')}}">
        <title>Abeer Jaipur Admin Panel</title>
		@include('layouts.common.admin-css')
    </head>
    <body class="sidebar-pinned page-home">
        @include('layouts.common.admin-sidebar')
        <main class="admin-main">
            <!--site header begins-->
            @include('layouts.common.admin-header')           
			<!--site header ends -->    
			@yield('content')
		</main>
    	@include('layouts.common.admin-js')
        @include('layouts.common.sweetalert')
    	@yield('js-script')
    </body>
</html>
