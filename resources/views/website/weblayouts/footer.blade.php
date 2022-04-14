<!-- Footer -->
<footer class="bg3 p-t-30 p-b-25">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-2 p-b-50">
					<h4 class="stext-301 cl0 p-b-10">
						About
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								About Us
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Contact Us
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								How It Work
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQ's
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-2 p-b-50">
					<h4 class="stext-301 cl0 p-b-10">
						Policy
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping Policy
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Return Policy 
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Term & Condition
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							    Privacy & Cookie Policy
							</a>
						</li>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Sitemap
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-2 p-b-50">
					<h4 class="stext-301 cl0 p-b-10">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns 
							</a>
						</li>
						@if(Auth::user())
							<li class="p-b-10">
								<a href="{{route('customerfeedback')}}" class="stext-107 cl7 hov-cl1 trans-04">
									Customer Feedback
								</a>
							</li>
						@endif

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Order FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-10">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? <br>
						Mail us at <span class="text-danger">{{isset($setting->email)? $setting->email:''}}</span><br>
						 OR 
						 <br>
						 Call us on <span class="text-danger">{{isset($setting->phone_one)? $setting->phone_one:''}}</span>
					</p>
                    
					<div class="flex-c-m flex-w p-b-18 p-t-27">
						<a href="#" class="m-all-1" >
							<img src="{{asset('customer_template/images/icons/linkedin.png')}}" alt="ICON-PAY">
						</a>

						<a href="#" class="m-all-1" target="_blank">
							<img src="{{asset('customer_template/images/icons/whatsapp.png')}}" alt="ICON-PAY">
						</a>

						<a href="#" class="m-all-1" target="_blank">
							<img src="{{asset('customer_template/images/icons/instagram.png')}}" alt="ICON-PAY">
						</a>

						<a href="{{isset($setting->facebook) ? $setting->facebook : '#'}}" target="_blank" class="m-all-1">
							<img src="{{asset('customer_template/images/icons/facebook.png')}}" alt="ICON-PAY">
						</a>

						
					</div>

					<!-- <div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div> -->
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-10">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
			
				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
             Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | With <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="{{isset($setting->created_by_company_link)? $setting->created_by_company_link:'#'}}" target="_blank">{{isset($setting->created_by_company)?$setting->created_by_company:''}}</a>
                   <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal2 p-t-60 p-b-20" id="quick_view">
		<div class="overlay-modal1 js-hide-modal2"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal2">
					<img src="{{asset('customer_template/images/icons/icon-close.png')}}" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							
							<div class="wrap-slick3 flex-sb flex-w">  
							     <div class="wrap-slick3-dots"></div> 
					            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div> 
								<div  id='quick_view_images'> 
								     <!-- image area in quick view --> 
								</div>
							</div> 		 
						</div>	
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<!-- start quick view form -->
					  <form id="quick_add_to_cart" name="quick_add_to_cart" method="post" action="{{route('add-to-cart')}}">
						@csrf
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								<span id="quick_view_title"></span>
							</h4>

							<span class="mtext-106 cl2">
							     <span id="quick_view_price"></span>
							</span>

							<p class="stext-102 cl3 p-t-23">
							  <span id="quick_view_short_description"></span>
						    </p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
										<span class="size_dropdown"></span>
											<input type="hidden" name="product_id" id="product_id"/>
											<select class="js-select2 quick_size_id" data-type="size" name="quick_size_id" id="quick_size_id">  
												<option>Choose an option</option>
											 
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Rental Length
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 " data-type="rental_length" name="rental_length" id="rental_length">
												<option>Choose an option</option>
												<option value="4">4 Days</option>
												<option value="10">10 Days</option>
												<option value="28">28 Days</option> 
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Select Dates
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
										   <input type="text" id="from_date" name="from_date"  class="form-control" placeholder="From Date" onfocus="(this.type='date')" onblur="(this.type='text')" min="{{date('Y-m-d')}}">
										</div>
									</div>
									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">										 
										 <input type="text" id="to_date" name="to_date"  class="form-control" placeholder="To Date" readonly>
										</div>
									</div>
								</div>
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
									 
											<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
												Add to cart
											</button>
										
									</div>
								</div>
								
								</form>	
								<!-- End quick view form -->
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="{{isset($setting->facebook)?$setting->facebook:'#'}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="{{isset($setting->facebook)?$setting->facebook:'#'}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

