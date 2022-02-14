@extends('website.weblayouts.master')
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('customer_template/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Forgot Password
    </h2>
</section>	
<section class="bg0 p-t-20 p-b-100">
    <div class="container">
        @if(Session::has('status'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">        
            {!! Session::get('status') !!}	
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>			
        </div>
        @endif
        <div class="flex-w flex-tr p-lr-250 p-tb-20">
            <div class="size-350 bor10 flex-w flex-col-m p-lr-20 p-tb-20 p-lr-15-lg w-full-md">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" >Email</lable>
                            <div class="bor8">
                                <input id="email" class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="email" name="email" :value="old('email')" required autofocus />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>
  
 
@endsection