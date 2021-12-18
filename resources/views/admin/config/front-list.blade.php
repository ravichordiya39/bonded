@extends('layouts.admin')
@section('content')
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> Front Configuration
                        </h4>
                        <p class="opacity-75 ">
                            Examples for form control styles, layout options, and custom components for
                            creating a wide variety of forms elements.
                            <br>
                            we have included dropzone for file uploads, datepicker and select2 for custom controls.
                        </p>


                    </div>
                </div>
            </div>
        </div>

        <div class=" pull-up">
            <div class="row">
                <div class="col-lg-12">
                    <!--widget card begin-->
                    <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                <i class="mdi mdi-checkbox-intermediate"></i> Front Configuration
                                <div class="pull-right"><a href="{{url('admin/config/front/edit')}}" class="btn btn-primary"> Edit Config</a></div>
                            </h5>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover ">
                                    <thead>
                                    <tr>           
										<th>Title</th>
										<th>Value</th>
										<th>Status</th>
										<th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									   @foreach($lists as $list)
									   <tr>
									     <td>{{$list->name}}</td>
									     <td>{{$list->key_value}}</td>
									     <td>@if($list->status) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									     <td>
									        @if($list->status==1)
									        <a href="javascript:;" data-id="{{$list->id}}" status="0" class="btn  btn-warning data-status"> In Active</a>
									        @else
									    	<a href="javascript:;" data-id="{{$list->id}}" status="1" class="btn  btn-success data-status"> Active</a>
									        @endif
										  	<!-- <a href="{{url('admin/config/cms/edit')}}/{{$list->id}}" class="btn  btn-primary"> Edit</a> -->
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
<script type="text/javascript">
$( document ).ready(function() {
    var csrf_token = '{{csrf_token()}}';
    var siteurl="{{url('admin/config')}}"
    $(document).on("click", ".data-status", function () {
        var id = $(this).data('id');
        var status=$(this).attr('status');
        var data = {_token: csrf_token, id: id,status:status};
        $.ajax({
            url: siteurl+'/front/status',
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
});
</script>
@endsection
