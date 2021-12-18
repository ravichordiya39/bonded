<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Abeer Jaipur</title>
    @include('layouts.common.default-css')
    <!-- Js Library -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    </script>
</head>
<body>
	<div class="wrapper">
    @include('layouts.common.default-header')
    @yield('content')
    @include('layouts.common.default-footer')
    @include('layouts.common.default-modals')
	</div>
    <!-- Wrapper -->
    @include('layouts.common.default-js')
    @include('layouts.common.sweetalert')
    <script>
        function showNotification(message, type, time, callback) {
    swal({
        title: type == "success" ? "Success" : "Error",
        icon: type,
        text: message,
        focusConfirm: false
    });
}
    </script>


<script type="text/javascript">
    // add remove product from wishlist goes here

    $(document).on('click',".favourite", function(){
            $cat_id  =   $(this).data("id");
            var id = $(this).attr('rel');
            $.ajax({
                method:'POST',
                url : APP_URL+"/product/favoriteOrRemove",
                data : {productId:$cat_id,_token: "{{ csrf_token() }}"},
                success:function(response){
                    if(response.statusCode == "200" && response.message =="Remove"){

                        $('#divcommenttextbox_'+id).removeClass("fa").addClass("far");
                    }
                    else if(response.statusCode == "200" && response.message =="Add"){

                        $('#divcommenttextbox_'+id).removeClass("far").addClass("fa");
                    }
                    else if(response.statusCode == "201")
                    {
                        jQuery.noConflict();
                        jQuery('#loginregister').modal();
                    }
                }
            });
        });
</script>
<script type="text/javascript">
    $(document).on('click',".add-cart-button", function(){
        $product_id  =   $(this).data("id");
        $item_id  =   $(this).data("pdid");
        $.ajax({
            method:'POST',
            url : APP_URL+"/cart/addJson",
            data : {pdid:$product_id,item_id:$item_id,_token: "{{ csrf_token() }}"},
            success:function(response){
                if(response.statusCode == "200"){
                    swal(response.message, "success");
                    $('#cart-total').html(response.html);
                }
                else if(response.statusCode == "201"){

                    swal(response.message, "error");
                }
                else if(response.statusCode == "201")
                {
                    jQuery.noConflict();
                    swal(response.message, "error");
                }
            }
        });
    });

    function woocs_redirect($val){
        $.ajax({
            method:'POST',
            url : APP_URL+"/product/changeCurrency",
            data : {currency:$val,_token: "{{ csrf_token() }}"},
            success:function(response){
                if(response.statusCode == "200"){
                    window.location.reload();
                }
                else if(response.statusCode == "201"){

                    
                }
                else if(response.statusCode == "201")
                {
                    jQuery.noConflict();
                   
                }
            }
        });
    }



$(function(){

// Document is ready
    $("#productSearch").keyup(function()
    {
        var minlength = 3;
        var value = $(this).val();
        if (value.length >= minlength ) {
            $.ajax({
                type: "GET",
                url: APP_URL+"/product/productSearch/search",
                data: {'search_keyword': value,_token: "{{ csrf_token() }}"},
                dataType: "text",
                success: function (data) {

                    $('#listingSerching').html(data);
                    //Receiving the result of search here
                }
            });
        }
        });
});
</script>
    @yield('js-script')
</body>
</html>
