@extends('layouts.admin')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class=""> Front Configuration</h4>
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
                            Front Configuration
                            <div class="pull-right"><a href="{{url('admin/config/front/list')}}" class="btn btn-primary">Front Configuration List</a></div>
                        </h5>
                    </div>
					<form  method="post" action="{{url('admin/config/front/save')}}" enctype="multipart/form-data">
					@csrf
                    <div class="card-body ">
					    <div class="form-row">
					    	@foreach($lists as $list)
							<div class="col-12 form-group ">
                            	<label>{{$list->name}}</label>
                            	<input type="text" class="form-control" name="{{$list->key_name}}" placeholder="{{$list->name}}" value="{{$list->key_value??''}}" required>
                        	</div>
                        	@endforeach	  
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
@endsection
