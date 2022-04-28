@extends('website.weblayouts.master')
@section('content')

@php
    $setting=DB::table('sitesettings')->first();
@endphp
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('customer_template/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Reach Us 
    </h2>
</section>	
<br>
@if(Session::has('success'))
        <div class="row center">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>

 @endif 

<!-- Content page -->
<section class="bg0 p-t-20 p-b-100">
    <div class="container">
        <div class="flex-w flex-tr" style="background-color:cornsilk">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form method="POST" action="{{route('contactus.store')}}">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Send Us A Message
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent" class="fontusername">
                        
                        <input @error('fullname') is-invalid @enderror class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" autocomplete="off" required type="text" name="fullname" placeholder="Your Full Name ">
                        @error('fullname')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" autocomplete="off" required  type="email" name="email" placeholder="Your Email Address">
                    </div>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" autocomplete="off" required type="text" name="phonenumber" placeholder="Your contact number">
                
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-10 p-tb-10" autocomplete="off" required  name="message" placeholder="How Can We Help?"></textarea>
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Submit
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md" style="background-color:beige">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span style="font-size:25px;"class="mtext-110 cl2">
                            Our Address
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                        <span><strong> {{isset($setting->company_name)?$setting->company_name:''}}</strong></span><br>
                           <span>{{isset($setting->company_address)?$setting->company_address:''}}</span>
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Lets Talk
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            {{isset($setting->phone_one)?$setting->phone_one:''}}
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Mail Us At
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            {{isset($setting->email)?$setting->email:''}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	


<!-- Map -->
<div class="map">
    <div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
</div>
@endsection