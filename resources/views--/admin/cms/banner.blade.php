@extends('layouts.admin')
@section('content')
<section class="admin-content">
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class=""> Banners
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
                           Banner
                           <!-- Button trigger modal -->
                            <div class="pull-right">
                            	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEditModal">
						  		Add Banner
								</button>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display" style="width:100%" id="table">
                                <thead>
                                <tr>
                                    <th>Banner</th>
                                    <th>Heading</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($lists as $list)
									<tr>
									<td><img src="{{$list->image_url}}" width="60px"></td>
									<td>{{ $list->heading}}</td>
									<td>{{ $list->description}}</td>
									<td>{{ $list->link}}</td>
                                    <td>{{ ucwords($list->btype)}}</td>
									<td>@if($list->status) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>
									@if($list->status==1)
							        <a href="javascript:;" data-id="{{$list->id}}" status="0" class="btn  btn-warning data-status"> <i class="fa fa-times"></i></a>
							        @else
							    	<a href="javascript:;" data-id="{{$list->id}}" status="1" class="btn  btn-success data-status"> <i class="fa fa-check"></i></a>
							        @endif
							        &nbsp;
									 <a href="javascript:;" data-id="{{$list->id}}" class="btn edit-data-btn btn-primary"><i class="fa fa-edit"></i></a> &nbsp;
									 <a href="javascript:;" data-id="{{$list->id}}" class="btn btn-danger delete-data-btn"><i class="fa fa-trash"></i></a>
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
<!-- Add Edit Modal -->
<div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEditModalLabel">Add Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<form  method="post" action="{{url('admin/config/banner/save')}}" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="id" id="id" value="0">
      <div class="modal-body">
       	<div class="form-row">
             <div class="form-group col-12">
                <label>Heading</label>
                <input type="text" class="form-control" name="heading" id="heading" placeholder="Heading" required>
            </div>   
          </div>  
          <div class="form-row">
             <div class="form-group col-12">
                <label>Link</label>
                <input type="url" class="form-control" name="link" id="link" >
            </div>   
          </div>
			<div class="form-row">
             <div class="form-group col-12">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>   
          </div>
          <div class="form-row">
             <div class="form-group col-12">
                <input type="checkbox" name="is_exclusive" id="is_exclusive" value="1" >&nbsp;&nbsp; Show on Exclusive Block &nbsp; &nbsp; &nbsp;
            </div>   
          </div>
          <div class="form-row">   
              <div class="form-group col-12">
                 <label >Choose Banner</label> 
					<input id="formImage" type="file" name="image" accept="image/*" class="form-control" required>
                    <input type="hidden" name="preImage" id="pre-image" value="">
					<br>
					<div id="catImg"></div>       
                </div>							   
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  	</form>
    </div>
  </div>
</div>
@endsection
@section('js-script')
<script>
$(document).ready(function () {
    var csrf_token = '{{csrf_token()}}';
    var siteurl="{{url('admin/config/banner')}}"
    $(document).on("click", ".data-status", function () {
            var id = $(this).data('id');
            var status=$(this).attr('status');
            var data = {_token: csrf_token, id: id,status:status};
            $.ajax({
                url: siteurl+'/status',
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
            return false;

        });
	$(document).on("click", ".edit-data-btn", function () {
        var id = $(this).data('id');
        var data = {_token: csrf_token, id: id};
        $.ajax({
            url: siteurl+'/edit',
            data: data,
            method: 'post',
            success: function (data, status, xhr) {
				$('#addEditModalLabel').text('Edit Banner');
                if (data.status == 1) {
                    var result = data.data;
                    $("#heading").val(result.heading);
                    $("#description").val(result.description);
                    $("#link").val(result.link);
                    $("#id").val(result.id);
                    
                    if(result.is_exclusive){
                        $('#is_exclusive').attr('checked',true);
                    }
                    if(result.image){
                    	$('#catImg').html('<img src="'+result.thumbnail_url+'" width="120px">')
                        $("#pre-image").val(result.image);
                        $('#formImage').attr('required', false); 
                    }
                   
                    $("#addEditModal").modal({
						 backdrop: 'static',
						 keyboard: false
					});
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
		return false;

    });
	
	
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
    $('#table').DataTable({
        "scrollX": true
    });
    
});

</script>
@endsection