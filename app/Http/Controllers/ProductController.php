<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\Models\Product;
use App\Models\Size;
use Auth;
use Session;
use Log;


class ProductController extends Controller
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
        Log::info($cart_items);
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
            $this->getCartDetail(); 
        } else {
 
            
            if(Session::has('products')) {
                $products = Session::get('products');
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
                $this->getCartDetail(); 
            } 
        }
        
       
    }
}
class SessionProducts
{
}