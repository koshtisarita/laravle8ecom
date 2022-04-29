<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\Models\Product;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Sub_Category;
use App\Models\Category;
use App\Models\Color;
use Auth;
use Session;
use Log;


class MainProductController extends Controller
{
    //============Add product into the cart ====================
    public function addToCart(Request $request) {
        $request_data = $request->all();
        Log::info($request_data);
        $product_id = $request->product_id;
       
        $cart_count = 0;    
        if(Auth::check()) {
            $cart_items = Cart::where('user_id', Auth::user()->id)->get()->keyBy('product_id');
            $cart_items_count = count($cart_items);
            // dd($cart_items_count);
            
            if(isset($cart_items[$product_id])) {
                $obj_cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
                $obj_cart->size_id = $request->quick_size_id;;
                $obj_cart->rental_length = $request->rental_length;
                $obj_cart->from_date = $request->from_date;
                $obj_cart->to_date = $request->to_date;
                $obj_cart->save();
                $msg = "Product detail updated to cart";
                
            } else {
                $obj_cart = new Cart();
                $obj_cart->user_id = Auth::user()->id;
                $obj_cart->product_id =  $request->product_id;
                $obj_cart->size_id = $request->quick_size_id;;
                $obj_cart->rental_length = $request->rental_length;
                $obj_cart->from_date = $request->from_date;
                $obj_cart->to_date = $request->to_date;
                $obj_cart->save();
                $msg = "Product has been added into the cart";
            }
            $cart_items = Cart::where('user_id', Auth::user()->id)->get();
            $cart_count = count($cart_items);
        } else {
            $obj_session_products = new SessionProducts();
            $obj_session_products->product_id = $request->product_id;
            $obj_session_products->quick_size_id = $request->quick_size_id;
            $obj_session_products->rental_length = $request->rental_length;
            $obj_session_products->from_date = $request->from_date;
            $obj_session_products->to_date = $request->to_date;
            $obj_session_products->quantity = 1;
            $products = [];
            
            if(Session::has('products')) {
                $products = Session::get('products');
               
                if(isset($products[$product_id])){
                    $session_product = $products[$product_id];
                    $session_product->quantity = 1;
                    $products[$product_id] = $session_product;
                    $msg = "Product have already been added to cart";
                } 
                else
                {
                    $obj_session_products->id = sizeof($products) + 1;
                    $products[$product_id] = $obj_session_products;
                    $msg = "Product has been added into the cart";
                }
              
                Session::put('products', $products);
                // dd(Session::get('products'));
                $cart_count = count($products);
            } else {
                $obj_session_products->id = 1;
                $products[$product_id] = $obj_session_products;
                Session::put('products', $products);
                $cart_count = count($products);
                $msg = "Product has been added into the cart";
                //dd(Session::get('products'));
            }
        }
        Log::info($products);
        return response()->json(['error'=>false,'message'=>$msg, 'cart_items_count' => $cart_count]);
        
        
    }
    // ==========   get the home page right cart detail ===========
    public function getCartItems() {
		$cart_items = [];
		 //Session::forget('products');

		if(Auth::check()) {
			$cart_items = Cart::where('user_id', Auth::user()->id)->get();
		} else if(Session::has('products')){
			$cart_items = Session::get('products');
		}					

		if(count($cart_items)>0)
		{
			$product_id_array = array();
			foreach($cart_items as $key=>$item){
				Log::info($cart_items[$key]->product_id);
                array_push($product_id_array,$cart_items[$key]->product_id);
			}
			 
            Log::info($product_id_array);
			$products = Product::orderBy('id','DESC')
            ->select('products.id','title','default_image', 'actual_price','discount')
            ->whereIn('products.id',$product_id_array)
            ->get()
			->keyBy('id'); 
            Log::info($products);
            $sizes  = Size::get()->keyBy('id');
			//dd($product_variants);
		}
		else
		{
			$sizes = [];
			$products = [];
		}
		//dd($products);
		$data = array('cart-items' => $cart_items, 'products' => $products, 'sizes' => $sizes);
	 
		
		return $data;
	}
	
     // ==========  remove item from cart ==============
    public function removeCartItem(Request $request) {
        $request_data = $request->all();
        $product_id = base64_decode($request_data['product-id']);
        if(Auth::check()) {
            $cart_items = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->delete();
        } else {
            if(Session::has('products')) {
                $products = Session::get('products'); 
                if(isset($products[$product_id])){
                    // delete this product
                    unset($products[$product_id]);
                }
               
                Session::put('products', $products);
              
            }
        }
        return redirect()->back();
    }


    /*--=============Get the product detail into the cart page================ */
    public function getCartDetail() {
        $cart_items = []; 
        if(Auth::check()) {
            $cart_items = Cart::where('user_id', Auth::user()->id)->get();
        } else if(Session::has('products')){
            $cart_items = Session::get('products');
        }
       
        if(count($cart_items)>0)
		{
            $product_id_array = array();
			foreach($cart_items as $key=>$item){
				 
                array_push($product_id_array,$item->product_id);
			}
			 
			$products = Product::orderBy('id','DESC')
            ->select('products.id','title','default_image', 'actual_price','discount')
            ->whereIn('products.id',$product_id_array)
            ->get()
			->keyBy('id')->toArray(); 

           
            $sizes  = Size::get()->keyBy('id');
			//dd($product_variants);
		}
		else
		{
			$sizes = [];
			$products = [];
		}
	   
	//   dd($product_id_array ,$cart_items,$products);
        return view('website.pages.cart')
            ->with('cart_items',$cart_items) 
            ->with('products',$products)
            ->with('sizes',$sizes);
		
		 
    }

    /*******************Update cart  from cart page*************** */
    public function updateCart(Request $request)
    {
        Log::info("Update cart function");
       
        if(Auth::check()) {
            for($i =0 ;$i<count($request->num_product1);$i++)
            {
                $obj_cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id_product1[$i])->first();                
                $obj_cart->quantity = $request->num_product1[$i];
                $obj_cart->save();
            } 
         
            $cart_items = Cart::where('user_id', Auth::user()->id)->get();
            $cart_count = count($cart_items);
            
        } else {
 
            
            if(Session::has('products')) {
                $cart_items = $products = Session::get('products');
                for($i =0 ;$i<count($request->num_product1);$i++)
                {
                    if(isset($products[$request->id_product1[$i]])){
                        $session_product = $products[$request->id_product1[$i]];
                        $session_product->quantity = $request->num_product1[$i];
                        $products[$request->id_product1[$i]] = $session_product;                        
                        
                    } 
                }
               
                Session::put('products', $products);               
                $cart_count = count($products);
                 
            } 
        }
       
       $this->getCartDetail();  
        
    }
   /****************** product listing page ******************/
    public function product_list(Request $request,$sub_cat_id){
         
        $sub_category = Sub_Category::where('sub_categories.id',$sub_cat_id)
        ->leftJoin('categories','sub_categories.category_id','=','categories.id')
        ->select('sub_categories.name','sub_categories.description','categories.name as cat_name')
        ->first();

        //dd($sub_category);

        $response = $this->getProduct( $request,$sub_cat_id,'');
        // dd($response);
        $products = $response['products'];
        $product_count = $response['product_count'];
        $start = $response['start']; 

       
        $brands = Brand::all();
        //menu for navigation bar
        $dynamicMenu =  MainWebController::dynamicMenu();
 
         $sizes = Size::all(); 
         $brands = Brand::all();
         $colors = Color::all();
         
         return view('website.pages.productlist',compact('sizes','brands','dynamicMenu','brands','products','product_count','start','sub_category','colors','sub_cat_id')); 
        
    }
    //Load more funtion
    function productFilter(Request $request){

        
        $response = $this->getProduct($request,'','');
        
        $products = $response['products'];
        $product_count = $response['product_count'];
        $start = $response['start']; 

       
        $product_list = '	<link rel="stylesheet" type="text/css" href="/customer_template/css/util.css">';
        $product_list = '	<link rel="stylesheet" type="text/css" href="/customer_template/css/main.css">';
      
        // $wishlist = null;
        // if(Auth::check())
        // {
        //     $user_id = Auth::User()->id;
        //     $wishlist = Wishlist::where('status', 1)->where('user_id', $user_id)->get()->groupBy('product_id');
        // }
         
        //Log::info($products);
       
        if(count($products)>0){
           
            foreach($products as $product)
            {
                $product_list .='<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ">';
               
                $product_list .='<div class="block2">';
                $product_list .='    <div class="block2-pic hov-img0">';
                $product_list .='<img  src="'.$product->default_image.'" alt="'.$product->title.'">';


                $product_list .='<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal2" data-id="'.$product->id.'">';
                $product_list .=' Quick View';
                $product_list .=' </a>';
                $product_list .='</div>';

                $product_list .='<div class="block2-txt flex-w flex-t p-t-14">';
                $product_list .='<div class="block2-txt-child1 flex-col-l ">';
                $product_list .='<a href="/product-detail" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">';
                $product_list .=$product->title;
                $product_list .='</a>';

                $product_list .='<span class="stext-105 cl3">';
                if($product->discount!="")
                     $product_list .='<b>£'.$product->discount.'</b> <br>RRP <strike>£'.$product->actual_price.'</strike>';
                 else
                    $product_list .='£'.$product->actual_price;
                
                 $product_list .='</span>';
                 $product_list .='</div>';

                 $product_list .='<div class="block2-txt-child2 flex-r p-t-3">';
                 $product_list .=' <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">';
                 $product_list .=' <img class="icon-heart1 dis-block trans-04"  src="/customer_template/images/icons/icon-heart-01.png" alt="ICON">';
                 $product_list .='<img class="icon-heart2 dis-block trans-04 ab-t-l"  src="/customer_template/images/icons/icon-heart-02.png" alt="ICON">';
                 $product_list .='</a>';
                 $product_list .='</div>';
                 $product_list .='</div>';
                 $product_list .='</div>';
                 $product_list .=' </div>';
            }
            $flag = 0;
        }else{
            $flag = 1;
            $product_list .='<div class="flex-c-m flex-w w-full p-t-30">No product available in this category, please select other category</h4></div>';
        }	
      
        Log::info($product_list);
        return response()->json(['product_list' => mb_convert_encoding($product_list, 'UTF-8', 'UTF-8'),
                        'flag' => $flag,'product_count'=>$product_count , 'start' => $start], 200);		
    }

    //filter function
    

    //generic function for load more, filter 
    function getProduct(Request $request,$sub_cat_id,$brand_id){

        $request_data = $request->all();
       
        $categories = array();
        $subcategories = array();
        $brands = array();
      
        $category_detail = [];
        
        if(isset($sub_cat_id) && $sub_cat_id > 0){
            $subcategories[] = $sub_cat_id;
            
        }

        //request parament
        if(isset($request->sub_cat) &&$request->sub_cat != ""){
            $subcategories[] = $request->sub_cat;
            
        }
       
      

        $others = array(); 
        $sizes = array(); 

         
            
        $filter_product = Product::select('products.*','brands.brand_name')
        ->leftJoin('brands','brands.id','products.brand_id')
        ->orderBy('products.id','DESC')
        ->where('products.status', 1) ;
       
        Log::info($filter_product->get());
        
          //size filter
          if(isset($request_data['size_filter']))
          {
            Log::info('size filter');
              $sizes = $request_data['size_filter']; 
              if(count($sizes) > 0){
                  // $filter_category_ids = array_unique(array_merge($subcategories));
                  $filter_size_ids = $sizes;
                  $filter_product =  $filter_product->where(function($query)use ($filter_size_ids) {
                      foreach( $filter_size_ids as $key => $size_id) {
                          if($key == 0){
                              $query = $query->where('products.size_id', 'LIKE', '%"'.$size_id.'"%');
                          }else{
                              $query = $query->orWhere('products.size_id', 'LIKE', '%"'.$size_id.'"%');
                          }
                      }
                  });
      
              } 
          }	
          
          //color filter
          if(isset($request_data['color_filter']))
          {
            Log::info('color filter');
              $colors = $request_data['color_filter']; 
              if(count($colors) > 0){
                  // $filter_category_ids = array_unique(array_merge($subcategories));
                  $filter_color_ids = $colors;
                  $filter_product =  $filter_product->where(function($query)use ($filter_color_ids) {
                      foreach( $filter_color_ids as $key => $color_id) {
                          if($key == 0){
                              $query = $query->where('products.color_id', 'LIKE', '%"'.$color_id.'"%');
                          }else{
                              $query = $query->orWhere('products.color_id', 'LIKE', '%"'.$color_id.'"%');
                          }
                      }
                  });
      
              } 
          }
          
           //Brand filter
          if(isset($request_data['brand_filter']))
          {
            Log::info('brand filter');
              $brands = $request_data['brand_filter']; 
              if(count($brands) > 0){ 
                  $filter_brand_ids = $brands;                
                  $filter_product = $filter_product->whereIn('products.brand_id', $filter_brand_ids); 
                 
              } 
          }
   
    
        if(count($subcategories) > 0){
            // $filter_category_ids = array_unique(array_merge($subcategories));
            $filter_category_ids = $subcategories;
            $filter_product =  $filter_product->where(function($query)use ($filter_category_ids) {
                foreach( $filter_category_ids as $key => $category_id) {
                    if($key == 0){
                        $query = $query->where('products.sub_categories', 'LIKE', '%"'.$category_id.'"%');
                    }else{
                        $query = $query->orWhere('products.sub_categories', 'LIKE', '%"'.$category_id.'"%');
                    }
                }
            });

        } 
        Log::info(count($filter_product->get()));

         //Price Filter
         if(isset($request_data['price_filter']) && $request_data['price_filter']=='1')
         {
             $filter_product = $filter_product; //1 = 'All `';
         }        
         elseif(isset($request_data['price_filter']) && $request_data['price_filter']=='2' )//2 = '£0.00 - £ 50.00';
         {
             $filter_product = $filter_product->where('products.discount', '>', 0)->where('products.discount', '<=', 50);
         }
         elseif(isset($request_data['price_filter']) && $request_data['price_filter']=='3')//3 = '£ 50.00 - £ 100.00';
         {	
             $filter_product = $filter_product->where('products.discount', '>', 50)->where('products.discount', '<=', 100);
         }
         elseif(isset($request_data['price_filter']) && $request_data['price_filter']=='4')//4 = '£ 100.00 - £ 150.00';
         {	          
             $filter_product = $filter_product->where('products.discount', '>', 100)->where('products.discount', '<=', 150);
         }
         elseif(isset($request_data['price_filter']) && $request_data['price_filter']=='5')//5 = '£ 150.00 - £ 200.00';
         {	          
             $filter_product = $filter_product->where('products.discount', '>', 105)->where('products.discount', '<=', 200);
         }
         elseif(isset($request_data['price_filter']) && $request_data['price_filter']=='6')//6 = '£ 200.00+';
         {
             $filter_product = $filter_product->where('products.discount', '>', 200); //6= '£ 200.00+`';
         }
         
         
         
        //Order by Filter
        if(isset($request_data['order_by']) && $request_data['order_by']=='1')//1 = 'Newness `';
        {
            Log::info('Newness');
            $filter_product = $filter_product->orderBy('products.id', 'DESC'); 
            Log::info($filter_product->get());
        }        
        elseif(isset($request_data['order_by']) && $request_data['order_by']=='2' )//2 = 'Product: A to Z';
        {
            Log::info('a to z');
            $filter_product = $filter_product->orderBy('products.title', 'ASC');
            Log::info($filter_product->get());
        }
        elseif(isset($request_data['order_by']) && $request_data['order_by']=='3')//3 = 'Product: Z to A';
        {	
            Log::info('z to a');
            $filter_product = $filter_product->orderBy('products.title', 'DESC');
            Log::info($filter_product->get());
        }
        elseif(isset($request_data['order_by']) && $request_data['order_by']=='4')//4 = 'Price: Low to High';
        {	    
            Log::info('low to high');      
            $filter_product = $filter_product->orderBy('products.discount', 'ASC');
            Log::info($filter_product->get());
        }
        elseif(isset($request_data['order_by']) && $request_data['order_by']=='5')//4 = 'Price: High to Low';
        {	     
            Log::info('high to low');     
            $filter_product = $filter_product->orderBy('products.discount', 'DESC');
            Log::info($filter_product->get());
        }
        else
        {
            Log::info('default');     
            $filter_product = $filter_product->orderBy('products.id', 'DESC'); //1 = 'Newness `';
        }
        

        $products = $filter_product->get();
        $product_count = count( $products);
        $limit = 2;
        $start = 0;
        if(isset($request_data['start']) && $request_data['start'] != "") {
            $start = $request_data['start'];
        }
		$products = collect($products)->slice($start, $limit)->all();
        
        $response = array();
        $response['products'] = $products;
        $response['product_count'] = $product_count;
        $response['start'] = $start; 
        return $response;

    }



     /****************** product Detail page ******************/
     public function product_detail(){
        $brands = Brand::all();
        //menu for navigation bar
        $dynamicMenu =  MainWebController::dynamicMenu();
        $sizes = Size::all();
         return view('website.pages.productdetail',compact('sizes','dynamicMenu','brands')); 
        }
}
class SessionProducts
{
}