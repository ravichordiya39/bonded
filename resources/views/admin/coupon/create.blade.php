@extends('layouts.admin')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Create New Coupon</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="JavaScriupt:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Coupon</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="page-title">
                            <h3 class="breadcrumb-header"><a href="{{ url('/admin/coupon') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a></h3>
                            <hr>
                        </div>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{url('admin/coupon')}}" class="form-horizontal" enctype="multipart/form-data">
                            @include ('admin.coupon.form', ['formMode' => 'create'])
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-script')