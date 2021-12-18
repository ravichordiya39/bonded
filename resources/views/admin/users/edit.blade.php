@extends('layouts.admin')
@section('content')
<div class="bg-dark">
  <div class="container  m-b-30">
     <div class="row">
        <div class="col-12 text-white p-t-40 p-b-90">
           <h4 class=""> user
           </h4>
           {{-- <p class="opacity-75 ">
              A product is identified by Category , Sub Category or other attributes.
              <br>
              Please input all fields to show a product on website. 
           </p> --}}
        </div>
     </div>
  </div>
</div>

    <!-- Main content -->
    <section class="container  pull-up">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/admin/users', $user->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        @include ('admin.users.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
