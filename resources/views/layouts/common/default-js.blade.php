<!-- Scripts FIle-->
<!-- Js Library -->
<script type="text/javascript" src="{{url('public/front')}}/js/wow.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/fancybox.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/slick.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('public/front')}}/js/function.js"></script>
<script type="text/javascript" src="{{url('public/js/sweetalert.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/additional-methods.js')}}"></script>
<script>
	$(document).ready(function(){
		var csrf_token = '{{csrf_token()}}';
        var siteurl="{{url('/')}}"
        $(document).on('click','.loginregister',function(){
            $('#loginregister').modal();
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
		
	});


    $(document).on('click','.remove-to-cart',function(){
            var id=$(this).data('id');
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                url: APP_URL+'/cart/remove',
                dataType:"json",
                type:"POST",
                data:{ _token : csrf_token, item_id : id },
                success:function(response){
                    window.location.href = "{{url('view-cart')}}";
                }
            })
        })
</script>