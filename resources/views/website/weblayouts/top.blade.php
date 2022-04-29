	
	<!-- Header -->
	<header class="header-v3">
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
			 
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">
					
					<!-- Logo desktop -->		
					<a href="{{route('index')}}" class="logo">
						<img src="/customer_template/images/icons/logo3.png" alt="IMG-LOGO" width="180" height='100'>
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
					@if(isset($dynamicMenu))
						<ul class="main-menu">
							 @foreach($dynamicMenu as $cat)  

							<li>
								<a href="#">{{ucfirst($cat['cat_name'])}}</a>
								@if($cat['has_child'])
								 
								<ul class="sub-menu">
								    @foreach($cat['child_cat_array'] as $child_link)
									
									<li><a href="/product-list/{{$child_link['child_cat_id']}}"> {{ucfirst($child_link['child_cat_name'])}}</a></li>
									@endforeach
									 
								</ul>
								 @endif
							</li>
						 
                             @endforeach
							<!-- <li class="label1" data-label1="hot">
								<a href="{{route('cart')}}">Features</a>
							</li>-->

							<li class="main-menu">
								<a href="{{route('all-brands')}}">Brands</a>
								<ul class="sub-menu">
								    @foreach($brands as $brand)
									
									<li><a href="/brand-list/{{$brand->id}}">{{ucfirst($brand->brand_name)}}</a></li>
									@endforeach
									 
								</ul>
							</li> 

							<li>
								<a href="{{route('about-us')}}">About</a>
							</li>

							<li>
								<a href="{{route('contact-us')}}">Contact</a>
							</li>
						</ul>
					@endif	
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m h-full">							
						<div class="flex-c-m h-full p-r-25 bor6">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart cart_count" data-notify="0">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						</div>
							
						<div class="flex-c-m h-full p-lr-19">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
								<i class="zmdi zmdi-menu"></i>
							</div>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="/"><img src="/customer_template/images/icons/logo3.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
				<div class="flex-c-m h-full p-r-5">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart cart_count" data-notify="2">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
		@if(isset($dynamicMenu))
			<ul class="main-menu-m">
					@foreach($dynamicMenu as $cat)  

				<li>
					<a href="#">{{ucfirst($cat['cat_name'])}}</a>
					@if($cat['has_child'])
						
					<ul class="sub-menu-m">
						@foreach($cat['child_cat_array'] as $child_link)
						
						<li><a href="/product-list/{{$child_link['child_cat_id']}}"> {{ucfirst($child_link['child_cat_name'])}}</a></li>
						@endforeach
							
					</ul>
						@endif
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>
				
					@endforeach
				<!-- <li class="label1" data-label1="hot">
					<a href="{{route('cart')}}">Features</a>
				</li>-->

				<li class="main-menu">
					<a href="{{route('all-brands')}}">Brands</a>
					<ul class="sub-menu-m">
						@foreach($brands as $brand)
						
						<li><a href="/brand-list/{{$brand->id}}">{{ucfirst($brand->brand_name)}}</a></li>
						@endforeach
							
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li> 

				<li>
					<a href="{{route('about-us')}}">About</a>
				</li>

				<li>
					<a href="{{route('contact-us')}}">Contact</a>
				</li>
			</ul>
		@endif	
			<!-- <ul class="main-menu-m">
				<li>
					<a href="/">Home</a>
					 
				</li>

				<li>
					<a href="#">Outfits</a>
					<ul class="sub-menu-m">
						<li><a href="">Homepage 1</a></li>
						<li><a href="">Homepage 2</a></li>
						<li><a href="">Homepage 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>
                <li>
					<a href="#">Occasions</a>
					<ul class="sub-menu-m">
					    <li><a href="">Homepage 1</a></li>
						<li><a href="">Homepage 2</a></li>
						<li><a href="">Homepage 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>
			  <li>
					<a href="shoping-{{route('cart')}}" class="label1 rs1" data-label1="hot">Features</a>
				</li>

				<li>
					<a href="blog.html">Blog</a>
				</li>  

				<li>
					<a href="{{route('about-us')}}">About</a>
				</li>

				<li>
					<a href="{{route('contact-us')}}">Contact</a>
				</li>
			</ul> -->
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<button class="flex-c-m btn-hide-modal-search trans-04">
				<i class="zmdi zmdi-close"></i>
			</button>

			<form class="container-search-header">
				<div class="wrap-search-header">
					<input class="plh0" type="text" name="search" placeholder="Search...">

					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
				</div>
			</form>
		</div>
	</header>


	<!-- Sidebar -->
	<aside class="wrap-sidebar js-sidebar">
		<div class="s-full js-hide-sidebar"></div>

		<div class="sidebar flex-col-l p-t-22 p-b-25">
			<div class="flex-r w-full p-b-30 p-r-27">
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
				<ul class="sidebar-link w-full">
					<li class="p-b-13">
						<a href="/" class="stext-102 cl2 hov-cl1 trans-04">
							Home
						</a>
					</li>
					@guest
					<li class="p-b-13">
						<a href="{{route('login-page')}}" class="stext-102 cl2 hov-cl1 trans-04">
							Login/Register
						</a>
					</li>
					@endguest
                    @auth
					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							My Wishlist
						</a>
					</li>

					<li class="p-b-13">
						<a href="{{route('myaccount')}}" class="stext-102 cl2 hov-cl1 trans-04">
							My Account
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							Track Oder
						</a>
					</li>

					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							Refunds
						</a>
					</li>
					<li class="p-b-13">
					    <form method="POST" action="{{ route('logout') }}">
                            @csrf
						    <button type="submit" name="submit" class="btn-link stext-102 cl2 hov-cl1 trans-04">
							Sign Out
							</button>
						</form>		
					</li>
                     @endauth
				 
				</ul>

				<div class="sidebar-gallery w-full p-tb-30">
					 
						<span class="mtext-101 cl5">
							About Us
						</span>

						<p class="stext-108 cl6 p-t-27">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus vulputate hendrerit. Praesent faucibus erat vitae rutrum gravida. Vestibulum tempus mi enim, in molestie sem fermentum quis. 
						</p>
				 
				</div>

				
			</div>
		</div>
	</aside>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll mini-cart__content">
			   
				 <!-- //dynamic data -->
			</div>
		</div>
	</div>
