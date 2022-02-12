@extends('website.weblayouts.master')
@section('content')
 <!-- BACKGROUND IMAGE  -->
 <!-- <img src="customer_template/images/back2.jpg" width="100%" height="100px"> -->
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('customer_template/images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Cart
	</h2>
</section>	

<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="{{route('index')}}" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			My Account
		</span>
	</div>
</div>
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
        <div class="flex-w flex-tr p-lr-250 p-tb-20">       

            <div class="size-300 bor10 flex-w flex-col-m p-lr-20 p-tb-10 p-lr-15-lg w-full-md">
                 <form method="POST" action="{{ route('register') }}">
                   @csrf
                   
                    <!-- First Name -->
                    <span class="error-font text-danger">{{ $errors->first('name')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{Auth::user()->name}}" type="text" name="name" placeholder="Enter your first name" required>
                    </div>
                    <!-- Last Name  -->
                    <span class="error-font text-danger">{{ $errors->first('lname')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{Auth::user()->lname}}" type="text" name="lname" placeholder="Enter your last name" required>
                    </div>
                    <!-- Email Address  -->
                    <span class="error-font text-danger">{{ $errors->first('remail')}}</span>  
                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{Auth::user()->email}}" type="remail" name="email" placeholder="Enter Your Email Address" readonly>
                     </div>
                     <!-- Date of birth  -->
                    <b> Date Of Birth </b> <span class="error-font text-danger">{{ $errors->first('dob')}}</span>  

                    <div class="bor8 m-b-10">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" value="{{date('mAuth::user()->dob}}" type="date" name="dob" placeholder="Enter your date of birth">
                    </div>                     
                    @if(Auth::user()->is_newsletter == 0)
                    <div class=" m-b-10">
                         <input id="is_newsletter" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="is_newsletter">
                        <span for="news letter"> {{__('I would like to receive exclusive promotions, the latest news and personalised information adapted to my customer profile via the following methods:') }} </span>
            
                    </div>
                    @endif
                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        update
                    </button>
                </form>
                
            </div>
            
        </div>
    </div>
</section>	
@endsection