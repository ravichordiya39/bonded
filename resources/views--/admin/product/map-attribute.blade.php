@extends('layouts.admin')
@section('content')
<section class="admin-content">
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class=""> Map Attributes
                </h4>
                <p class="opacity-75 ">
                    There are a large variety of products from different categories.
                    <br>
                    Here you are able to make those categories which are not available on portal.
                </p>
            </div>
        </div>
    </div>
</div>
    <div class="container  pull-up">
        <div class="row">	
            <div class="col-lg-12">
                <!--widget card begin-->
                <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                           Map Attributes
                           <!-- Button trigger modal -->
                            <div class="pull-right">
                            	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEditModal">
						  		Add Category
								</button> -->
								<a href="{{url('admin/product/map-attribute/add')}}" class="btn btn-primary">
						  		Add Mapping Attribute
								</a>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Brand</th>
                                    <th>Occassion</th>
                                    <th>Fabric</th>
                                    <th>Pattern</th>
                                    <th>Material</th>
                                    <th>Design</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($lists as $list)
									<tr>
									<td>{{ $list->cat->name}}</td>
									<td>@if($list->is_size) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_color) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_brand) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_occasion) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_fabric) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_pattern) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_material) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->is_design) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>@if($list->status) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>
									 <a href="{{url('admin/product/map-attribute/edit')}}/{{$list->id}}" data-id="{{$list->id}}" class="btn edit-data-btn-n btn-primary"> Edit</a>
									 <a href="javascript:;" data-id="{{$list->id}}" class="btn btn-danger delete-data-btn"> Delete</a>
								</td>
									</tr>
									@endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
            </div>
        </div>
    </div>
</section>
@endsection
@section('js-script')
<script>
$(document).ready(function () {
    var csrf_token = '{{csrf_token()}}';
    var siteurl="{{url('admin/product/map-attribute')}}"
    $(document).on("click", ".delete-data-btn", function () {
        if (confirm("Deleting Selected Data! Are you sure?")) {
            var id = $(this).data('id');
            deleteData(id);
        }
    });
    function deleteData(pid) {
        var data = {_token: csrf_token, id: pid};
        $.ajax({
            url: siteurl+'/delete',
            data: data,
            method: 'post',
            success: function (data, status, xhr) {
                if (data.status == 1) {
                	swal({
				        title: "Success",
				        text: data.message,
				        type: "success",
				        timer: 3000,
				        showConfirmButton: false
				    });
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
    }
    
});

</script>
@endsection