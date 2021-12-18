<!-- Scripts FIle-->
<!-- Js Library -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/wow.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/fancybox.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/slick.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/function.js"></script>
<script type="text/javascript" src="{{url('public/js/sweetalert.js')}}"></script>
<script>
	$(document).ready(function(){
		var csrf_token = '{{csrf_token()}}';
        var siteurl="{{url('/')}}"
        $(document).on('click','.loginregister',function(){
            $('#loginregister').modal();
        })
		$(document).on('click','.add_to_wishlist',function(){
			var pid=$(this).data('id');
			var data = {_token: csrf_token, id: pid,status:1};
			actionWishlist(data);
		})
		$(document).on('click','.remove_to_wishlist',function(){
			var pid=$(this).data('id');
			var data = {_token: csrf_token, id: pid,status:0};
			actionWishlist(data);
		})
        $(document).on('click','.add-to-cart',function(){
            var id=$(this).data('id');
            var pdid=$(this).data('pdid')
            $.ajax({
                url: siteurl+'/cart/add',
                dataType:"json",
                type:"POST",
                data:{ _token : csrf_token, item_id : id,pdid:pdid },
                success:function(response){
                    window.location.href = "{{url('view-cart')}}";
                }
            })
        })
        $(document).on('click','.remove-to-cart',function(){
            var id=$(this).data('id');
            $.ajax({
                url: siteurl+'/cart/remove',
                dataType:"json",
                type:"POST",
                data:{ _token : csrf_token, item_id : id },
                success:function(response){
                    window.location.href = "{{url('view-cart')}}";
                }
            })
        })
		function actionWishlist(rdata){
            $.ajax({
                url: siteurl+'/user/product/wishlist/save',
                data: rdata,
                method: 'post',
                success: function (data, status, xhr) {
                    if (data.status == 1) {
                    	var result=data.data;
                        swal({
                            title: "Success",
                            text: data.message,
                            type: "success",
                            timer: 3000,
                            showConfirmButton: false
                        });
                        if(result.status==1){
                        	$('#wishtext'+result.product_id).text('Remove from wishlist')
                        	$('#wish'+result.product_id).toggleClass('add_to_wishlist remove_to_wishlist')
                        }else{
                        	$('#wishtext'+result.product_id).text('Add in wishlist')
                        	$('#wish'+result.product_id).toggleClass('add_to_wishlist remove_to_wishlist')
                        }
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    } else {
                        swal({
                            title: "Warning",
                            text: data.message,
                            type: "warning",
                            timer: 3000,
                            showConfirmButton: false
                        });             
                    }
                },
                failure: function (status) {
                    console.log(status);
                }
            });
            return true;
		}
	});
</script>