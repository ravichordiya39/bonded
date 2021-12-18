@extends('layouts.admin')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class=""> CMS(FAQ) Page</h4>
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
                            CMS Page(FAQ)
                            <div class="pull-right"><a href="{{url('admin/config/cms/list')}}" class="btn btn-primary">CMS Page List</a></div>
                        </h5>
                    </div>
					<form  method="post" action="{{url('admin/config/cms/save')}}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{$page->id??0}}">
					<?php 
					$f=0;
					$faqs=array();
					if ($page->description) {
						$faqs=json_decode($page->description);
					}
					// dd($faqs);
					$ftypes = array('image' =>'Image','youtube'=>'Youtube','vimeo'=>'Vimeo' );
					$ctypes=array('about'=>'About Us','privacy'=>'Privacy Policy','terms'=>'Terms  & Condition','faq'=>'FAQ','contact'=>'Contact Us','shipping'=>'Shipping And Delivery');
					?>
                    <div class="card-body ">
					    <div class="form-row">
							<div class="col-6 form-group ">
					         	<label>Select Page</label>
                                <select class="form-control js-select2-s" name="ctype" id="ctype" disabled readonly>
									<option value="">Select Page</option>
									@foreach($ctypes as $key=>$type)
									@if(isset($page->ctype) && $key==$page->ctype)
									<option value="{{$key}}" selected>{{$type}}</option>
									@else
									<option value="{{$key}}">{{$type}}</option>
									@endif
									@endforeach
								</select>
								<input type="hidden" name="ftype" value="image">
								<input type="hidden" name="ctype" value="faq">
                            </div>
							<div class="col-6 form-group ">
                            	<label>Title</label>
                            	<input type="text" class="form-control" name="title" placeholder="Title" value="{{$page->title??''}}" required>
                        	</div> 	
                        	{{--<!--<div class="col-6 form-group">
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
							</div>  -->--}}    
                    	</div>				
                    	<div id="faqDiv" class="rows">
                    		@if($faqs)
                    		@foreach($faqs as $faq)
                    		<div class="faqDiv">
                    		<div class="col-12 form-group ">
                            	<label>Question Title &nbsp;&nbsp;@if($f==0)<a href="javascript:;" class="btn btn-primary pull-right addFAQ">Add More</a>@else <a href="javascript:;" class="btn btn-danger pull-right removeFAQ"><i class="fa fa-trash"></i></a> @endif</label>
                            	<input type="text" class="form-control" name="qa[{{$f}}][title]" placeholder="Title" value="{{$faq->title??''}}" required>
                        	</div>                 
	                        <div class="col-12 form-group ">
	                            <label>Answer</label>
	                            <textarea name="qa[{{$f}}][description]" class="form-control">{{$faq->description??''}}</textarea>
	                        </div>
	                        </div>
	                        @php($f+=1)
	                        @endforeach
                    		@else
                    		<div class="col-12 form-group ">
                            	<label>Question Title &nbsp;&nbsp;<a href="javascript:;" class="btn btn-primary pull-right addFAQ">Add More</a></label>
                            	<input type="text" class="form-control" name="qa[0][title]" placeholder="Title" value="" required>
                        	</div>                 
	                        <div class="col-12 form-group ">
	                            <label>Answer</label>
	                            <textarea name="qa[0][description]" class="form-control"></textarea>
	                        </div>
                    		@endif
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
// bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
$(document).ready(function () {
	var token="{{ csrf_token() }}";
	var f="{{$f}}";
	$(document).on('click','.addFAQ',function(){
		f=Number(f);
		f+=1;
		$('#faqDiv').append(`<div  class="faqDiv">
		                        <div class="col-12 form-group ">
	                            	<label>Question Title &nbsp;&nbsp;<a href="javascript:;" class="btn btn-danger pull-right removeFAQ"><i class="fa fa-trash"></i></a></label>
	                            	<input type="text" class="form-control" name="qa[`+f+`][title]" placeholder="Title" value="" required>
	                        	</div>                 
		                        <div class="col-12 form-group ">
		                            <label>Answer</label>
		                            <textarea name="qa[`+f+`][description]" class="form-control"></textarea>
		                        </div>
		                        </div>`)
	})
	$(document).on('click','.removeFAQ',function(){
		$(this).closest(".faqDiv").remove();
	})
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
});	
</script>
@endsection
