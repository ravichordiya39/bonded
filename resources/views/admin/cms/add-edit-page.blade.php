@extends('layouts.admin')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class=""> CMS Page</h4>
                    <p class="opacity-75 ">
                        A product is identified by Category , Sub Category or other attributes.
                        <br>
                       Please input all fields to show a product on website. 
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">
                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            CMS Page
                            <div class="pull-right"><a href="{{url('admin/config/cms/list')}}" class="btn btn-primary">CMS Page List</a></div>
                        </h5>
                    </div>
					<form  method="post" action="{{url('admin/config/cms/save')}}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{$page->id??0}}">
					<?php 
					$ftypes = array('image' =>'Image','youtube'=>'Youtube','vimeo'=>'Vimeo' );
					$ctypes=array('about'=>'About Us','privacy'=>'Privacy Policy','terms'=>'Terms  & Condition','faq'=>'FAQ','contact'=>'Contact Us','shipping'=>'Shipping And Delivery');
					?>
                    <div class="card-body ">
					    <div class="form-row">
							<div class="col-6 form-group ">
					         	<label>Select Page</label>
                                <select class="form-control js-select2" name="ctype" id="ctype" required>
									<option value="">Select Page</option>
									@foreach($ctypes as $key=>$type)
									@if(isset($page->ctype) && $key==$page->ctype)
									<option value="{{$key}}" selected>{{$type}}</option>
									@else
									<option value="{{$key}}">{{$type}}</option>
									@endif
									@endforeach
								</select>
                            </div>
							<div class="col-6 form-group ">
                            	<label>Title</label>
                            	<input type="text" class="form-control" name="title" placeholder="Title" value="{{$page->title??''}}" required>
                        	</div> 	
                        	<div class="col-6 form-group">
                        		<label>Select Type</label>
                        		<select name="ftype" id="ftype" class="form-control" required>
									@foreach($ftypes as $key=>$ftype)
									@if(isset($page->ftype) && $key==$page->ftype)
									<option value="{{$key}}" selected>{{$ftype}}</option>
									@else
									<option value="{{$key}}">{{$ftype}}</option>
									@endif
									@endforeach
								</select>
                        	</div>
                        	<div class="form-group col-6" id="doc_div" @if(isset($page->ftype) && $page->ftype!='image') style="display:none" @endif>
                        		<label>Blog Image</label>
                            	<input type="file" class="form-control" id="image" name="image" @if(!isset($page->image)) required @endif onchange="validateimg(this,1920,450)">
                            	 <p class="notice">(Preferred Image resolution in 1920x450px Max 1 Mb)</p>
                            	  @if(isset($page->image) && $page->image)
								 <img src="{{$page->thumbnail_url}}">
								 @endif
							</div>
							<div class="form-group col-6" id="video_div" @if(isset($page->ftype) && ($page->ftype=='image' || $page->ftype=='video')) style="display:none" @elseif(!isset($page->ftype)) style="display:none" @endif>
								<label >Video Link</label>
								<input type="text" name="video_link" id="video_link" class="form-control" placeholder="Video Link" value="{{$page->video_link??''}}">
								<p class="notice">(Please enter the embeded code)</p>  
							</div>                   
	                        <div class="col-12 form-group ">
	                            <label>Description</label>
	                             <textarea name="description" id="description" class="form-control">{{$page->description??''}}</textarea>
	                        </div>   
                    	</div>					   
	                    <div class="form-group">
	                        <button type="submit" class="btn btn-primary">Submit</button>
	                    </div>
	                </div>
					</form>
                </div> 		
            </div>
        </div>
    </div>
</section>
@endsection
@section('js-script')
<script type="text/javascript" src="{{url('public/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
$(document).ready(function () {
	var token="{{ csrf_token() }}";
	$("#ftype").change(function () {
       	if($(this).val() == 'youtube' || $(this).val() == 'vimeo') {
           $("#video_div").show();
           $('#image').attr('required',false)
           $('#video_link').attr('required',true)
           $("#doc_div").hide();
       	}else{
           $("#doc_div").show();
           $('#video_link').attr('required',false)
           $('#image').attr('required',true)
           $("#video_div").hide();
       	}
		});
	$(document).on('change','#cat_id',function(){
		var id=$(this).val(); 
		$.ajax({
	    	url : "{{url('config/get-subcat')}}",
	    	type: "POST",
	    	data : {cat_id:id, _token:token},
			 success: function (data, status, xhr) {
                if (data.status == 1) {
                    $("#scat_id").html('');
                    $("#scat_id").html(data.data);
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
	}); 
	function validateimg(ctrl,uwidth,uheight) { 
		
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
						console.log(width+"ssdsd"+height); 
                        if (height > uheight || width > uwidth) {
                            alert("Please upload image with "+uwidth+"x"+uheight+" resolution.");
							fileUpload.value="";
                            return true;
                        }else{
                           
                            return true;
                        }
                    };
                }
            } else {
                alert("This browser does not support HTML5.");
                return false;
            }
        } else {
            alert("Please select a valid Image file.");
            return false;
        }
    }
});	
</script>
@endsection
