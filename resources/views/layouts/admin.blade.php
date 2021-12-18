<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="siteurl" id="siteurl" content="{{url('/')}}">
        <title>Bonded Coir Admin Panel</title>
		@include('layouts.common.admin-css')
        <script type="text/javascript">
            var ADMIN_URL = {!! json_encode(url('/admin/')) !!}
            </script>
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
        <script>
            function showNotification(message, type, time, callback) {
            swal({
                title: type == "success" ? "Success" : "Error",
                icon: type,
                text: message,
                timer: 3000,
                showConfirmButton: false
            });
        }
        </script>
    	@yield('js-script')
    </body>
</html>
