@extends('website.weblayouts.master')
@section('content')
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
				<!-- <div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
						Women
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
						Men
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
						Bag
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".shoes">
						Shoes
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".watches">
						Watches
					</button>
				</div> -->

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
					<form>
 
						<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
					
							<div class="filter-col1 p-r-15 p-b-27">
								<div class="mtext-102 cl2 p-b-15">
									Sort By
								</div>
                                <select class="filter-inputs" id="" name="">
                                     <option value="1">Newness</option>
									 <option value="1">Product: A to Z</option>
									 <option value="1">Product: Z to A</option>
									 <option value="1">Price: Low to High</option>
									 <option value="1">Price: High to Low</option>

								</select>
							 
							</div>

							<div class="filter-col2 p-r-15 p-b-27">
								<div class="mtext-102 cl2 p-b-15">
									Price
								</div>
								<select class="filter-inputs" id="" name="">
                                     <option value="1">All</option>
									 <option value="1">£0.00 - £ 50.00</option>
									 <option value="1">£ 50.00 - £ 100.00</option>
									 <option value="1">£ 100.00 - £ 150.00</option>
									 <option value="1">£ 150.00 - £ 200.00</option>
									 <option value="1">£ 200.00+</option>

								</select>
							 
							</div>

							<div class="filter-col3 p-r-15 p-b-27">
								<div class="mtext-102 cl2 p-b-15">
									Size
								</div>
								 
								<select class="filter-inputs" id="" name=""> 
									@foreach($sizes as $size)
											<option value="{{$size->id}}">{{$size->size_no}}/{{$size->size_shortcut}}</option>
										
									@endforeach
								</select>	
								 
							</div>

							<div class="filter-col4 p-b-27">
								<div class="mtext-102 cl2 p-b-15">
									Brands
								</div>
								<select class="filter-inputs" id="" name=""> 
									@foreach($brands as $brand)
											<option value="{{$brand->id}}">{{$brand->brand_name}}</option>
										
									@endforeach
								</select>	
								 
							</div>
							<div class="filter-col5 p-b-27">
								<div class="mtext-102 cl2 p-b-15">
									Length
								</div>
								<select class="filter-inputs" id="" name="">
                                     <option value="1">All</option>
									 <option value="1">MIDI</option>
									 <option value="1">LONG</option>
								</select>
							 
							</div>
						</div>
						
					</div>
					</form>
				
			</div>
		 
			<div class="row isotope-grid">
		 
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
			 
			 
			</div>

			@if($product_count >24)
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
			@endif
			@else
			<div class="flex-c-m flex-w w-full p-t-30">
                   ------------------- No Recoed Found ----------------------
			</div>

			@endif
		</div>
	</div>
		
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
      
			start = start + 24;      
      
			var filter_url;
		    sub_cat_id = $('#sub_cat_id').val().trim();
			brand_id=$('#brand_id').val().trim();
			// var sec_url='{{Request::segment(3)}}';     
			filter_url='/product-filter';		 
 

			$.ajax({
				url: filter_url,
				type: 'POST',
				data:{
					"_token": "{{ csrf_token() }}",
					'start':start,
					'brand_id':brand_id,
					
				},
				success: function(data, textStatus, jqXHR){            
					   //console.log(data);
						if(data.flag == 0) {
							$('.product-list').append(data.product_list);
              $("#product_count").html(data.product_count);
							$("#product-msg").css('display','none');
              if(data.start == 0){
                start = data.start;
                fetch_more = true;
              }
              var page =data.product_count -  start;
              // console.log("start "+start);
              
              $("#load_more_section").hide();
              fetch_more = false;
              if(page > 24)
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

	// $(document).on('change', '.filter-box', function(ev) {		
		// 	$('#filter-products').submit();
		// });
		
		// $("#filter-products").submit(function(ev){			
		// 	ev.preventDefault();	
		// 	$(this).find(".error.text-danger").remove();
		// 	$(this).find(".has-error").removeClass("has-error");
		// 	var formURL = $(this).attr("action");
		// 	var postData = $(this).serializeArray(); 
		// 	$.ajax({
		// 		url: formURL,
		// 		type: 'POST',
		// 		data: postData,				
		// 		success: function(data,textStatus, jqXHR){					
          		
		// 			$('.product-list').html(data.product_list);
        //   $("#product-msg").css('display','none');
        //   $("#product_count").html(data.product_count);
        //   $("#load_more_section").hide();
        //   fetch_more = false;
        //   if(data.start == 0){
        //     start = data.start;
        //     fetch_more = true;
        //   }
        //   var page = data.product_count - start;
        //   if(page > 24)
        //   {
        //     fetch_more = true;
        //     $("#load_more_section").show();             
        //   } else {
             
        //       $("#load_more_section").hide();
		// 					fetch_more = false;
		// 		  		}
					
		// 		},
		// 		error: function(jqXHR, textStatus, errorThrown){
		// 			var errResponse = JSON.parse(jqXHR.responseText);
		// 			if (errResponse.error) {
		// 				$.each(errResponse.error, function(index, value)
		// 				{ 	
		// 					if (value.length != 0)
		// 					{
		// 						var $inpElm = $("#" + index);
		// 						$inpElm.closest('.form-group').addClass('has-error');
		// 						$inpElm.closest('.form-group').append('<span class="col-md-12 error text-danger text-center">' + value + '</span>');
		// 					}
		// 				});
		// 			}
		// 		},
		// 	});
		// 	return false;
		// });	
		// $("#filter-products-mobile").submit(function(ev){
		// 	ev.preventDefault();	
      
		// 	$(this).find(".error.text-danger").remove();
		// 	$(this).find(".has-error").removeClass("has-error");
		// 	var formURL = $(this).attr("action");
		// 	var postData = $(this).serializeArray(); 
		// 	$.ajax({
		// 		url: formURL,
		// 		type: 'POST',
		// 		data: postData,
		// 		success: function(data, textStatus, jqXHR){
        //   $('.product-list').html(data.product_list);
        //   $("#product-msg").css('display','none');
        //   $("#product_count").html(data.product_count);
        //   $("#load_more_section").hide();
        //   fetch_more = true;
        //   // var page = data.product_count - start;
        //   $('.filter-to-left').removeClass('active');
        //   $('.overlay-filter').removeClass('active'); 
					
		// 		},
		// 		error: function(jqXHR, textStatus, errorThrown){
		// 			var errResponse = JSON.parse(jqXHR.responseText);
		// 			if (errResponse.error) {
		// 				$.each(errResponse.error, function(index, value)
		// 				{ 	
		// 					if (value.length != 0)
		// 					{
		// 						var $inpElm = $("#" + index);
		// 						$inpElm.closest('.form-group').addClass('has-error');
		// 						$inpElm.closest('.form-group').append('<span class="col-md-12 error text-danger text-center">' + value + '</span>');
		// 					}
		// 				});
		// 			}
		// 		},
		// 	});
		// });	

});
</script>
@endsection