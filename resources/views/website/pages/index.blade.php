@extends('website.weblayouts.master')
@section('content')



	<!-- Slider -->
	<section class="section-slide" style="z-index=1000;">
		<div class="wrap-slick1 rs2-slick1">
			<div class="slick1">
				@foreach($sliders as $slider)
				<div class="item-slick1 bg-overlay1" style="background-image: url({{$slider->image_path}});" >
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									{!!$slider->sub_title!!}
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
								    {!!$slider->title!!}
								</h2>
							</div>
							@if($slider->hyperlink!="")	 
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="{{$slider->hyperlink}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
							@endif
						</div>
					</div>
				</div>
				@endforeach
				

				<!-- <div class="item-slick1 bg-overlay1" style="background-image: url(customer_template/images/slide-06.jpg);" data-thumb="images/thumb-02.jpg" data-caption="Men’s Wear">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Men New-Season
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									Jackets & Coats
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1 bg-overlay1" style="background-image: url(customer_template/images/slide-07.jpg);" data-thumb="images/thumb-03.jpg" data-caption="Men’s Wear">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									Men Collection 2018
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									NEW SEASON
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div> -->
			</div>

			<!-- <div class="wrap-slick1-dots p-lr-10"></div> -->
		</div>
	</section>

    	<!-- Banner -->
	<div class="">
		<div class="container">
			<div class="row" style="margin-left: 187px;margin-top: -31px;">
				<div class="col-md-10 col-xs-12 col-sm-12 respon5">
					 <div class="card text-white bg-dark ">
						<div class="card-body">
						      <p class='text-center p-b-20'><b>BOOK YOUR RENTALS NOW</b></p>

							  <form name="index_page_serch" id="index_page_serch" method="POST" action="">
								  @csrf
								<div class="form-row">
									<div class="col-5">
									    <select id="size_id" name="size_id" class="form-control">
                                           <option value="">Choose Size</option>
										   @foreach($sizes as $key=>$size)
										       <option value="{{$size->id}}">{{$size->size_no}}/{{$size->size_shortcut}}</option>
										   @endforeach
										</select>
									</div>
									<div class="col-5">
									   <input type="text" id="delivery_date" name="delivery_date"  class="form-control" placeholder="Delivery Date" onfocus="(this.type='date')" onblur="(this.type='text')" min="{{date('Y-m-d')}}">
									</div>
									<div class="col-2">
									 <button type="submit" class="btn btn-warning" name="submit"> Find Outfit</button>
									</div>
								</div>
							   </form>
						</div>
					</div>
				</div>
            </div>
		</div>
	</div>	
	<!-- category -->
	<div class="sec-banner bg0 p-t-30 p-b-10">
		<div class="container">
			<div class="row">
				@foreach($categories as $category)
				<div class="col-md-6 p-b-10 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{$category->image_path}}" alt="IMG-BANNER">

						<a href="{{$category->link}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
								     {{$category->name}}
								</span>
 
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
                @endforeach 
			 
 
			</div>
		</div>
	</div>

    <!-- New Arrival Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-20">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					New Arrivals
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@foreach($new_arrival as $product)
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{$product->default_image}}" alt="{{$product->title}}">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2" data-id="{{$product->id}}">
								
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									    {{$product->title}}
									</a>

									<span class="stext-105 cl3">
									    @if($product->discount!="")
										<b>£{{$product->discount}}</b> <br>RRP <strike>£{{$product->actual_price}}</strike>
										@else
										£{{$product->actual_price}}
										@endif
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
                   @endforeach
					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					 	<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-02.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Herschel supply
									</a>

									<span class="stext-105 cl3">
										$35.31
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						 
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-03.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Only Check Trouser
									</a>

									<span class="stext-105 cl3">
										$25.50
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					 
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-04.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Classic Trench Coat
									</a>

									<span class="stext-105 cl3">
										$75.00
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-05.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Front Pocket Jumper
									</a>

									<span class="stext-105 cl3">
										$34.75
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					    <div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-06.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Vintage Inspired Classic 
									</a>

									<span class="stext-105 cl3">
										$93.20
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					 
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-07.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Shirt in Stretch Cotton
									</a>

									<span class="stext-105 cl3">
										$52.66
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					 
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="customer_template/images/product-08.jpg" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Pieces Metallic Printed
									</a>

									<span class="stext-105 cl3">
										$18.96
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</section>
		

	<!-- Most Popular Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-20">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Most Popular
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
				   @foreach($most_popular as $product)
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{$product->default_image}}" alt="{{$product->title}}">

								<a href="#" data-id="{{$product->id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									    {{$product->title}}
									</a>

									<span class="stext-105 cl3">
									    @if($product->discount!="")
										<b>£{{$product->discount}}</b> <br>RRP <strike>£{{$product->actual_price}}</strike>
										@else
										£{{$product->actual_price}}
										@endif
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
                   @endforeach
				</div>
			</div>
		</div>
	</section>

	<!-- Most Viewed Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-20">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Most Viewed
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
				@foreach($most_viewed as $product)
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{$product->default_image}}" alt="{{$product->title}}">

								<a href="#" data-id="{{$product->id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04"><!--js-show-modal2-->
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="{{route('product-detail')}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									    {{$product->title}}
									</a>

									<span class="stext-105 cl3">
									    @if($product->discount!="")
										<b>£{{$product->discount}}</b> <br>RRP <strike>£{{$product->actual_price}}</strike>
										@else
										£{{$product->actual_price}}
										@endif
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
                   @endforeach
 
				</div>
			</div>
		</div>
	</section>	
<!-- jQuery -->
<script src="{{asset('template/js/jquery.js')}}"></script>
 



@endsection