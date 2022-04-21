<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\Models\Product;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Sub_Category;
use App\Models\Category;
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
        
        return response()->json(['error'=>false,'message'=>$msg, 'cart_items_count' => $cart_count]);
        
        
    }
    // ==========   get the home page right cart detail ===========
    public function getCartItems() {
		$cart_items = [];
		 // Session::forget('products');

		if(Auth::check()) {
			$cart_items = Cart::where('user_id', Auth::user()->id)->get();
		} else if(Session::has('products')){
			$cart_items = Session::get('products');
		}					

		if(count($cart_items)>0)
		{
			$product_id_array = array();
			foreach($cart_items as $key=>$item){
				Log::info($cart_items[$key]->id);
                array_push($product_id_array,$cart_items[$key]->id);
			}
			 
			$products = Product::orderBy('id','DESC')
            ->select('products.id','title','default_image', 'actual_price','discount')
            ->whereIn('products.id',$product_id_array)
            ->get()
			->keyBy('id'); 
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
        // Log::info($cart_items);
        if(count($cart_items)>0)
		{
            $product_id_array = array();
			foreach($cart_items as $key=>$item){
				 
                array_push($product_id_array,$cart_items[$key]->id);
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
         
         return view('website.pages.productlist',compact('sizes','dynamicMenu','brands','products','product_count','start','sub_category')); 
        
    }
 
    function getProduct(Request $request,$sub_cat_id,$brand_id){
        $request_data = $request->all();
        $categories = array();
        $subcategories = array();
        $brands = array();
      
        $category_detail = [];
        
        if(isset($sub_cat_id) && $sub_cat_id > 0){
            $subcategories[] = $sub_cat_id;
            
        }
       
       
      

        $others = array(); 
        $sizes = array(); 

         
            
        $filter_product = Product::select('products.*','brands.brand_name')
        ->leftJoin('brands','brands.id','products.brand_id')
        ->where('products.status', 1) ;
       
        // if(isset($request_data['sizes']))
        // {
        //     $sizes = $request_data['sizes'];
        //     $filter_product = $filter_product->whereIn('size_id', $sizes);
        // }			


        if(isset($brand_id) && $brand_id > 0){
            $filter_product = $filter_product->where('brand_id', $brand_id);
        }


        if(isset($request_data['sizes']))
        {
            $size = $request_data['sizes'];
            $filter_product = $filter_product->where('products.size_id', 'LIKE', '%"'.$size.'"%');
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
      

        // if(isset($request_data['other']) && $request_data['other']=='1')
        // {
        //     $products = $products->orderBy('product.name', 'ASC'); //1 = 'A to Z';
        // }        
        // elseif(isset($request_data['other']) && $request_data['other']=='2' )//2 = 'Z to A';
        // {
        //     $products = $products->orderBy('product.name', 'DESC');
        // }elseif(isset($request_data['other']) && $request_data['other']=='3')//3 = 'Price high to low';
        // {	
        //     $ids_ordered = implode(',', $filter_product_variants_product_id);
        //     $products = $products->orderByRaw("FIELD(product.id, $ids_ordered)");
        // }
        // elseif(isset($request_data['other']) && $request_data['other']=='4')//4 = 'Price low to high';
        // {	          
        //     $ids_ordered = implode(',', $filter_product_variants_product_id);
        //     $products = $products->orderByRaw("FIELD(product.id, $ids_ordered)");
        // }
        // else if(!isset($request_data['other']))
        // {
        //     $products = $products->orderBy('product.name', 'ASC'); //1 = 'A to Z';
        // }

        $products = $filter_product->get();
        $product_count = count( $products);
        $limit = 24;
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