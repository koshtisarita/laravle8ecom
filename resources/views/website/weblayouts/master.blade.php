<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hire Dress</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('customer_template/images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('customer_template/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body class="animsition">

    @include('website.weblayouts.top')
	<!-- main content  -->
	@yield('content')
    @include('website.weblayouts.footer')
	

<!--===============================================================================================-->	
	<script src="{{asset('customer_template/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('customer_template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('customer_template/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('customer_template/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/sweetalert/sweetalert.min.js')}}"></script>

<!--===============================================================================================-->
	<script src="{{asset('customer_template/js/main.js')}}"></script>
    <script>
		$(document).ready(function(){
		getCartItems();
	});
  //get the cart detail to fill the landing page data
  function getCartItems()
  {
    $.ajax({
        url: '/cart-items',
        type: 'POST',
        data:{"_token": "{{ csrf_token() }}"},
        success: function(data, textStatus, jqXHR) { 
        
          var cart_items = data['cart-items'];          
          var products = data['products'];
          var sizes = data['sizes'];
          var cart_html = '';
          var total = 0;
          var cart_items_count = 0;         

          cart_html += '<ul class="header-cart-wrapitem w-full mini-cart-list">';
          $.each(cart_items, function(index, item) {
            cart_items_count = cart_items_count + 1;            
		 
            var product_id = btoa(item.product_id);//base64 encode
             var remove_url = "/remove-cart?product-id="+product_id;
			var product_name = products[item.product_id].title;
			debugger;
			var product_image = products[item.product_id].default_image;
			var actual_price = products[item.product_id].actual_price;
			var discount = products[item.product_id].discount;
			var quantity = parseInt(item.quantity); 
			var price =0;
			if(discount !== "")
			{ 
			   price = discount;		  
         
			}
			else
			{
			  price = actual_price;
			  
			}
			total = total + (price * parseInt(item.quantity));
	 
            cart_html += ' <li class="header-cart-item flex-w flex-t m-b-12">';
            cart_html += ' <div class="header-cart-item-img"><img src="'+product_image+'" alt="IMG"></div>';
            cart_html += '<div class="header-cart-item-txt p-t-8"><a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+product_name+'</a>';
            cart_html +=  '<span class="header-cart-item-info">'+ quantity+' X £ '+price+'</span></div>';
			
			cart_html +=' <div  class="quick-remove"><a href="'+remove_url+'"><img src="customer_template/images/icons/icon-close2.png" alt="IMG" width="10px" height="10px"></a></div>';
            cart_html += '</li>';

          });
              
            cart_html += '</ul>';		 
            cart_html += ' <div class="w-full"><div class="header-cart-total w-full p-tb-40">Total: £'+total+'</div>';
            cart_html += ' <div class="header-cart-buttons flex-w w-full">'; 
            cart_html += '<a href="{{route('cart')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">View Cart</a>'; 
            cart_html += '<a href="{{route('cart')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">Checkout</a>';
            cart_html += ' </div></div>';
            
            if(cart_items_count>0) 
            {
                    $(".mini-cart__content").html(cart_html);
                    $('.cart_count').attr('data-notify',cart_items_count);
            }
            else
            {
                  $(".mini-cart__content").html('<h3>Card is empty</h3>'); 
				  $('.cart_count').attr('data-notify',cart_items_count);
            }
        },
        error: function(err) {
        console.log('error getting cart items: ', err);
        },
    });
  }
   </script>
<!--===============================================================================-->

	<script>
		$("#from_date").on("blur",function(e){
			e.preventDefault();
			debugger;
			 var rental_length = ($("#rental_length").val()!=="")?parseInt($("#rental_length").val()):"";
			 if(!isNaN(rental_length))
			 {
					var from_date = new Date($("#from_date").val());
				from_date.setDate(from_date.getDate() + rental_length);
				$("#to_date").val(from_date.toInputFormat());
			 }
			 else
			 {
				swal("Please select the rental Length. ");
			 }
			
		    
            
		});
		Date.prototype.toInputFormat = function() {
	
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    };
	</script>	
	<script>
	  $('.js-show-modal2').on('click',function(e){
        e.preventDefault();
        var html ='';
		$("#quick_view_images").html(html); 
        var product_id = $(this).attr('data-id');
        $.ajax({
            url: '/get-quick-view-data/'+product_id,
            type: 'GET',                
            success: function(data, textStatus, jqXHR) {                   
                 console.log(data);
                 if(data.result == 1){        
 
                     
					// html+='<div class="wrap-slick3-dots"></div>';
					// html+='<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>';
					html+='<div class="slick3 gallery-lb">'
                    html+='<div class="item-slick3" data-thumb="'+data.default_image+'">';
                    html+='<div class="wrap-pic-w pos-relative">';
                    html+='        <img src="'+data.default_image+'" alt="IMG-PRODUCT">';

                    html+='<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+data.default_image+'">';
                    html+='<i class="fa fa-expand"></i>';
                    html+='</a></div></div>';                  
              

                    // if(data.is_detail_image_div)
                    // {
                    //     for(var i=0; i<data.is_detail_image_div; i++)
                    //     {
                            
                    //         html+='<div class="item-slick3" data-thumb="'+data.detail_image[i]['image_path']+'">';
                    //         html+='<div class="wrap-pic-w pos-relative">';
                    //         html+='        <img src="'+data.detail_image[i]['image_path']+'" alt="IMG-PRODUCT">';
        
                    //         html+='<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+data.detail_image[i]['image_path']+'">';
                    //         html+='<i class="fa fa-expand"></i>';
                    //         html+='</a></div></div>';                  
                         
                    //     }
                    // }
					html+='</div>';     
                    if(data.is_size > 0)
					{
						var size_value = '<option value="">Choose Size </option>';							
						$(".quick_size_id").empty();
						$(".quick_size_id").append(size_value);
						for(var i=0;i<data.is_size;i++ )
						{
							  var size_value = '<option value="'+data.product_size[i]["id"]+'">'+data.product_size[i]["size_no"]+'/'+data.product_size[i]["size_shortcut"]+'</option>';
							  $(".quick_size_id").append(size_value);
						}
					}
                    $("#quick_view_images").append(html); 
                    $("#quick_view_title").html(data.title); 
                    $("#quick_view_price").html(data.price); 
                    $("#quick_view_short_description").html(data.short_description); 
                    $("#quick_add_to_cart #product_id").val(data.id);

                    $('.js-modal2').addClass('show-modal1');
                 }
                 else{
                   
                    alert(result.message);
                 }
                  

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
        
    });
		  $('.js-hide-modal2').on('click',function(){
				$('.js-modal2').removeClass('show-modal1');
			});
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				// call ajax to add item in wish list
				swal(nameProduct, "is added to wishlist !", "success");
				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){				 

				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');

				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		//$('.js-addcart-detail').each(function(){
		$('#quick_add_to_cart').on('submit',function(e){	
			e.preventDefault();
		    debugger
			var form_data = $('#quick_add_to_cart').serialize(); 		 		
			$.ajax({
					url : '{{route("add-to-cart")}}', // or whatever 
					type: 'POST',
					data: form_data,
					success: function(data, textStatus, jqXHR) {
                     console.log(data);
					 var nameProduct = $('#quick_view_title').html();
                        if(data.error == false)
						{
							swal(nameProduct, data.message, "success");
							 
							//wait 3 second sand then reload the page

							setTimeout(function(){location.reload();}, 2000);  
							
						}
						else
						{
							swal(nameProduct, "is not added to cart. Please try again", "success");
						}
					
					}
				});
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('customer_template/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>


</body>
</html>