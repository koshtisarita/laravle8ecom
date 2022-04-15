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
                
            } else {
                $obj_cart = new Cart();
                $obj_cart->user_id = Auth::user()->id;
                $obj_cart->product_id =  $request->product_id;
                $obj_cart->size_id = $request->quick_size_id;;
                $obj_cart->rental_length = $request->rental_length;
                $obj_cart->from_date = $request->from_date;
                $obj_cart->to_date = $request->to_date;
                $obj_cart->save();
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
                } else {
                    $obj_session_products->id = sizeof($products) + 1;
                    $products[$product_id] = $obj_session_products;
                }
              
                Session::put('products', $products);
                // dd(Session::get('products'));
                $cart_count = count($products);
            } else {
                $obj_session_products->id = 1;
                $products[$product_id] = $obj_session_products;
                Session::put('products', $products);
                $cart_count = count($products);
                //dd(Session::get('products'));
            }
        }
        
        
        if(isset($request_data['page']))
        {
            return response()->json(['error'=>false,'message'=>'Product added in cart.', 'cart_items_count' => $cart_count]);
        }
            return response()->json(['error'=>false,'message'=>'Product added in cart.', 'cart_items_count' => $cart_count]);
        
        
    }
    
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
			foreach($cart_items as $key=>$item){
				Log::info($cart_items[$key]->id);
			}
			Log::info($cart_items);
			$products = Product::orderBy('id','DESC')
            ->select('products.id','title','default_image', 'actual_price','discount')
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
	
    //remove item from cart
    public function removeCartItem(Request $request) {
        $request_data = $request->all();
        $product_id = base64_decode($request_data['product-id']);
        if(Auth::check()) {
            $cart_items = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->delete();
        } else {
            if(Session::has('products')) {
                $products = Session::get('products');
                //dd($products);
                if(isset($products[$product_id])){
                    // delete this product
                    unset($products[$product_id]);
                }
                //dd($products);
                Session::put('products', $products);
                //dd(Session::get('products'));
            }
        }
        return redirect()->back();
    }

}
class SessionProducts
{
}