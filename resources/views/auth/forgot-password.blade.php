@extends('layouts.default')
@section('content')
<x-guest-layout>
   
    <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">Forgot Your Password?</h1>
          </div>
          <div class="row">
           
            <div class="content-area col-md-12 col-sm-12 col-12">
              <div class="content-section">
                <p>Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.</p>
                 <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                  
                    <div class="form-group required">
                        <x-label for="email" :value="__('Email')" />
        
                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
        
                                     
                  <div class="d-flex justify-content-between">
                    <x-button>
                        {{ __('Reset password') }}
                    </x-button>
                              
                     
                  </div>
                </form>
              </div>
            </div>
            <!--content-area-->
          </div>
          <!-- row -->
        </div>
        <!--container-->
      </div>    

    
</x-guest-layout>
@endsection
