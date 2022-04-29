@extends('website.weblayouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/select2/select2.min.css')}}">
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('/customer_template/images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		<br>
	   {{$sub_category->cat_name}} / {{$sub_category->name}} 
	</h2>
	@if($sub_category->description !="")
	<br>
	<h5 class="ltext-80 cl0 txt-center">{{$sub_category->description }}</h5>
	@endif
</section>

<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			@if($product_count >0)
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				        <h5>Total product in this category: <span id="product_count_result"> {{$product_count}}</span></h5>
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<!-- <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div> -->
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>
               
					<!-- Filter -->
					<div class="dis-none panel-filter w-full p-t-10">
					<form id="filter-products"  method="POST" action="/products/filter"> 
                        @csrf
						<!--- Input values set from get method -->
						<input type="hidden" name="sub_cat_id" id="sub_cat_id" value="{{$sub_cat_id}}">
						<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
					
						    <div class="filter-col1 flex-w flex-r-m p-b-27">
							     <div class="mtext-102 cl2 p-b-10 mr-3">
									 Sort By
								</div>

								<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 filter-box" name="order_by" id="order_by" >
											    <option value="1">Newness</option>
												<option value="2">Product: A to Z</option>
												<option value="3">Product: Z to A</option>
												<option value="4">Price: Low to High</option>
												<option value="5">Price: High to Low</option>

											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
							</div>
							<div class="filter-col2 flex-w flex-r-m p-b-27">
							     <div class="mtext-102 cl2 p-b-10 mr-3">
									Price
								</div>

								<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 filter-box"  name="price_filter" id="price_filter">
											 
											    <option value="1">All</option>
												<option value="2">£ 0.00 - £ 50.00</option>
												<option value="3">£ 50.00 - £ 100.00</option>
												<option value="4">£ 100.00 - £ 150.00</option>
												<option value="5">£ 150.00 - £ 200.00</option>
												<option value="6">£ 200.00+</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
							</div>
							<div class="filter-col3 flex-w flex-r-m p-b-27">
							     <div class="mtext-102 cl2 p-b-10 mr-3">
									Size
								</div>

								<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 filter-box" name="size_filter[]" id="size_filter" multiple>
											    @foreach($sizes as $size)
														<option value="{{$size->id}}">{{$size->size_no}}/{{$size->size_shortcut}}</option>
													
												@endforeach

											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
							</div>
							<div class="filter-col4 flex-w flex-r-m p-b-27">
							     <div class="mtext-102 cl2 p-b-10 mr-3">
									Brand
								</div>

								<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 filter-box" name="brand_filter[]" id="brand_filter"  multiple>
											    @foreach($brands as $brand)
														<option value="{{$brand->id}}">{{$brand->brand_name}}</option>
													
												@endforeach

											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
							</div>
							<div class="filter-col5 flex-w flex-r-m p-b-27">
							     <div class="mtext-102 cl2 p-b-10 mr-3">
									Color
								</div>

								<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 filter-box" name="color_filter[]" id="color_filter"  multiple>
											    @foreach($colors as $color)
														<option value="{{$color->id}}" style="background:{{$color->color_code}}">{{$color->name}}</option>
													
												@endforeach
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
							</div>
				 
						</div>
						
					</div>
					</form>
				
			</div>
		 
			<div class="row isotope-grid product-list" >
		 
				@foreach($products as $product)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img  src="{{$product->default_image}}" alt="{{$product->title}}">


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
										<img class="icon-heart1 dis-block trans-04"  src="/customer_template/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l"  src="/customer_template/images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				<!-- <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				 
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="/customer_template/images/product-01.jpg" alt="IMG-PRODUCT">

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									Esprit Ruffle Shirt
								</a>

								<span class="stext-105 cl3">
									$16.64
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div> -->

			 
			</div>

			@if($product_count >1)
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45" id="load_more_section">
				<a href="#" id="load_more" class="flex-c-m stext-101 cl5 size-103 bg3 bor1 hov-btn3 p-lr-15 trans-04">
					Load More
				</a>
			</div>
			@endif
			@else
			<div class="flex-c-m flex-w w-full p-t-30">
			No product available in this category, please select other category
			</div>

			@endif
		</div>
	</div>
		

<!-- jQuery -->
<script src="{{asset('template/js/jquery.js')}}"></script>
<script src="{{asset('customer_template/vendor/select2/select2.min.js')}}"></script>
<script>
$(function()
{ 
	var start = 0;
	var fetch_more = true;
			
	$(window).scroll(function() {
				//loadNextProducts();
			});


	$(document).on("click", "#load_more" , function() {
		loadNextProducts();
		});

	$(document.body).on('touchmove', loadNextProducts);

   function loadNextProducts() 
   { 
      console.log('fetch more ',fetch_more);
 
		if(fetch_more)
		{
      
			debugger;
			start = start + 1;      
      
			var filter_url;
		    sub_cat_id = $('#sub_cat_id').val();
			// brand_id=$('#brand_id').val().trim();
			// var sec_url='{{Request::segment(3)}}';     
			filter_url='/product-filter';		 
 

			$.ajax({
				url: filter_url,
				type: 'POST',
				data:{
					"_token": "{{ csrf_token() }}",
					'start':start,
					'sub_cat':sub_cat_id,
					
				},
				success: function(data, textStatus, jqXHR){            
					   //console.log(data);
						if(data.flag == 0) {
							$('.product-list').append(data.product_list);
                            $("#product_count").html(data.product_count);
							// $("#product-msg").css('display','none');
              if(data.start == 0){
                start = data.start;
                fetch_more = true;
              }
              var page =data.product_count -  start;
              // console.log("start "+start);
              
              $("#load_more_section").hide();
              fetch_more = false;
              if(page > 1)
              {
                $("#load_more_section").show(); 
                fetch_more = true;
                $("#load_more").show();
              }
                                         
						} else {
              //$('.product-list').append('No More products found');
              $("#load_more_section").hide();
							fetch_more = false;
				  		}
				},
				error: function(jqXHR, textStatus, errorThrown){
					var errResponse = JSON.parse(jqXHR.responseText);
					if (errResponse.error) {
						$.each(errResponse.error, function(index, value)
						{ 	
							if (value.length != 0)
							{
								var $inpElm = $("#" + index);
								$inpElm.closest('.form-group').addClass('has-error');
								$inpElm.closest('.form-group').append('<span class="col-md-12 error text-danger text-center">' + value + '</span>');
							}
						});
					}
				},
			});
		}
   }

   $(document).on('change', '.filter-box', function(ev) {	
	debugger;			
			$('#filter-products').submit();
	});
		
	$("#filter-products").submit(function(ev){	
		   debugger;		
			ev.preventDefault();	
			 
			var formURL = $(this).attr("action");
			var postData = $(this).serializeArray(); 
			$.ajax({
				url: formURL,
				type: 'POST',
				data: postData,				
				success: function(data,textStatus, jqXHR){					
          		
					debugger;
					$('.product-list').html(data.product_list);
					$("#product-msg").css('display','none');
					$("#product_count").html(data.product_count);
					$("#load_more_section").hide();
					fetch_more = false;
					if(data.start == 0){
						start = data.start;
						fetch_more = true;
					}
					var page = data.product_count - start;
					if(page > 24)
					{
						fetch_more = true;
						$("#load_more_section").show();             
					} 
					else 
					{
						
					    $("#load_more_section").hide();
						fetch_more = false;
					}
						
		     },
			error: function(jqXHR, textStatus, errorThrown){
				var errResponse = JSON.parse(jqXHR.responseText);
				if (errResponse.error) {
					$.each(errResponse.error, function(index, value)
					{ 	
						if (value.length != 0)
						{
							var $inpElm = $("#" + index);
							$inpElm.closest('.form-group').addClass('has-error');
							$inpElm.closest('.form-group').append('<span class="col-md-12 error text-danger text-center">' + value + '</span>');
						}
					});
				}
			},
		});
		return false;
	});	
	$("#filter-products-mobile").submit(function(ev){
			ev.preventDefault();	
      
			$(this).find(".error.text-danger").remove();
			$(this).find(".has-error").removeClass("has-error");
			var formURL = $(this).attr("action");
			var postData = $(this).serializeArray(); 
			$.ajax({
				url: formURL,
				type: 'POST',
				data: postData,
				success: function(data, textStatus, jqXHR){
					$('.product-list').html(data.product_list);
					$("#product-msg").css('display','none');
					$("#product_count").html(data.product_count);
					$("#load_more_section").hide();
					fetch_more = true;
				 
								
				},
				error: function(jqXHR, textStatus, errorThrown){
					var errResponse = JSON.parse(jqXHR.responseText);
					if (errResponse.error) {
						$.each(errResponse.error, function(index, value)
						{ 	
							if (value.length != 0)
							{
								var $inpElm = $("#" + index);
								$inpElm.closest('.form-group').addClass('has-error');
								$inpElm.closest('.form-group').append('<span class="col-md-12 error text-danger text-center">' + value + '</span>');
							}
						});
					}
				},
			});
		});	

});
</script>
@endsection