@extends('website.weblayouts.master')
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('customer_template/images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
      Login/Registration
	</h2>
</section>
<!-- Content page -->
<section class="bg0 p-t-20 p-b-100">
    <div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">        
            {!! Session::get('success') !!}	
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>			
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable fade show" role="alert">        
            {!! Session::get('error') !!}	
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>			
        </div>
        @endif
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-20 p-t-10 p-b-0 p-lr-15-lg w-full-md">
                <form method="POST" action="{{ route('loginform') }}">
                       @csrf

                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Login
                    </h4>
                    <span class="error-font text-danger">{{ $errors->first('email')}}</span>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Your Email Address" required>
                        <img class="how-pos4 pointer-none" src="customer_template/images/icons/icon-email.png" alt="ICON">
                       
                    </div>
                    <span class="error-font text-danger">{{ $errors->first('password')}}</span>
                    <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="Your Password" required>
                        <img class="how-pos4 pointer-none" src="customer_template/images/icons/download.png" alt="ICON">
                        
                    </div>

                    <button  type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Submit
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-20 p-tb-10 p-lr-15-lg w-full-md">
             <form method="POST" action="{{ route('register') }}">
                   @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Registration
                    </h4>
                    <!-- First Name -->
                    <span class="error-font text-danger">{{ $errors->first('name')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{old('name')}}" type="text" name="name" placeholder="Enter your first name" required>
                    </div>
                    <!-- Last Name  -->
                    <span class="error-font text-danger">{{ $errors->first('lname')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{old('lname')}}" type="text" name="lname" placeholder="Enter your last name" required>
                    </div>
                    <!-- Email Address  -->
                    <span class="error-font text-danger">{{ $errors->first('remail')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{old('remail')}}" type="remail" name="email" placeholder="Enter Your Email Address" required>
                     </div>
                     <!-- Date of birth  -->
                    <b> Date Of Birth </b> <span class="error-font text-danger">{{ $errors->first('dob')}}</span>  

                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{old('dob')}}" type="date" name="dob" placeholder="Enter your date of birth">
                    </div>
                    <!-- Password  -->
                    <span class="error-font text-danger">{{ $errors->first('rpassword')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30"  type="password" name="rpassword" placeholder="Create your password" required>
                        
                    </div>
                    <!-- Confirm password  -->
                    <span class="error-font text-danger">{{ $errors->first('rpassword_confirmation')}}</span>  
                    <div class="  m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30"  type="password" name="rpassword_confirmation" placeholder="Enter your confirm password" required>
                        
                    </div>
                    
                    <div class=" m-b-10">
                         <input id="is_newsletter" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="is_newsletter">
                        <span for="news letter"> {{__('I would like to receive exclusive promotions, the latest news and personalised information adapted to my customer profile via the following methods:') }} </span>
            
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>	

@endsection