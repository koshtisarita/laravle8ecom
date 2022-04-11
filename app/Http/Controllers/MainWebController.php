<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Sub_Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use Log;
use Hash;
use Socialite;
use Validator;
use DB;
class MainWebController extends Controller
{
     public function index(){
         //landing page slider
         $sliders= Slider::where('status','=',1)->get();   
         //size for search  
         $sizes = Size::all();
         //category and sub_category
         $categories= Category::all()->keyBy('id');
         
         $subCategories = Sub_Category::get()->keyBy('id');

         $new_arrival = Product::where("status",1)->where("is_newarrival",1)->orderBy('id','DESC')->get();

         $most_popular= Product::where("status",1)->orderBy('id','DESC')->get();

         $most_viewed=Product::where("status",1)->orderBy('view_count','DESC')->get();

         return view('website.pages.index',compact('sliders','categories','sizes','new_arrival','most_popular','most_viewed'));
    }
     
    public function quick_view_data(Product $product)
    { 
        if($product){
            $id = $product->id;
            $product_images =[];
            $product_images = ProductImage::where('product_id',$product->id)->get()->toArray();   
            
            // $image_html = "";
            // $image_html .='<link rel="stylesheet" type="text/css" href="customer_template/vendor/slick/slick.css">';
            // $image_html .='<script src="customer_template/vendor/slick/slick.min.js"></script>';
            // $image_html .='<link rel="stylesheet" type="text/css" href="customer_template/css/main.css">';
            // $image_html .='<div class="wrap-slick3 flex-sb flex-w">';
            // $image_html .='<div class="wrap-slick3-dots"></div>';
            // $image_html .='<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>';

            // $image_html .='<div class="slick3 gallery-lb">';
            // $image_html .='<div class="item-slick3" data-thumb="'.$product->default_image.'">';
            // $image_html .='<div class="wrap-pic-w pos-relative">';
            // $image_html .='<img src="'.$product->default_image.'" alt="IMG-PRODUCT">';

            // $image_html .='<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$product->default_image.'">
            //                 <i class="fa fa-expand"></i>';
            // $image_html .='</a>';
            // $image_html .=' </div>
            //     </div>';
            // if(count($product_images))
            // {
              

            //     foreach($product_images as $images)
            //     {
                   
            //         $image_html .='<div class="item-slick3" data-thumb="'.$images->image_path.'">';
            //         $image_html .='<div class="wrap-pic-w pos-relative">';
            //         $image_html .='<img src="'.$images->image_path.'" alt="IMG-PRODUCT">';

            //         $image_html .='<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$images->image_path.'">
            //                         <i class="fa fa-expand"></i>';
            //         $image_html .='</a>';
            //         $image_html .=' </div>
            //             </div>';

            //    }    
            //     $image_html .=' </div>
            //     </div>';
            // }
            


            //price
            if($product->is_discount)
            {
                $price = "<b>£$product->discount</b> <br>RRP <strike>£$product->actual_price</strike>";
            }
            else
            {
                $price = "<b>£$product->actual_price</b>";
            }

            $sizes = Size::whereIn('id',json_decode($product->size_id))->get()->toArray();  

            $response = [
                'result'=>1,
                'id'=>$product->id,   
                'is_size'=> count(json_decode($product->size_id)), 
                'product_size'=>$sizes,       
                'price'=>$price,               
                'short_description'=>htmlspecialchars_decode($product->short_description),
                'title'=>$product->title,
                'is_detail_image_div'=>count($product_images),
                'detail_image'=>$product_images,
                'default_image'=>$product->default_image
                
            ];             
        }
        
        return $response;
    }
     
    public function contactus(){ $sizes = Size::all(); return view('website.pages.contactus',compact('sizes')); }
     public function aboutus(){ $sizes = Size::all(); return view('website.pages.aboutus',compact('sizes'));}
     public function cart(){ $sizes = Size::all(); return view('website.pages.cart',compact('sizes'));}
     public function product_list(){$sizes = Size::all(); return view('website.pages.productlist',compact('sizes'));}
     public function product_detail(){
        $sizes = Size::all();
         return view('website.pages.productdetail',compact('sizes'));
        }
     public function loginpage(){   $sizes = Size::all(); return view('website.pages.login_registration',compact('sizes'));}
     //login check
     public function store(Request $request)
     {
          
            $email = trim($request->email);

            
            $user = User::where('email','=',$email)->get()->first();
            Log::info($user);
            if($user != null)
            {
                $password = $user->password;
                if(Hash::check($request->password, $password))
                {     
                        //Admin Check
                        if ($user->role_id == 0)
                        {   
                            $request->session()->regenerate();
                            Auth::login($user);
                            return redirect('/view-dashboard'); 
                        } 
                        else
                        {                             
                            if($user->status == 1)
                             {                                  
                                 $request->session()->regenerate();
                                 Auth::login($user);
                                 return redirect()->route('index');
                                //  return redirect()->intended(RouteServiceProvider::HOME);
                            }
                            else
                            { 
                                return redirect()->back()->with('error','Your account is inactive. please check your register email for active your account');
                            }
                        }
                    
                }
                else
                {
                    return redirect()->back()->with('error','The provided password is incorrect.');
                }
            }
            else{
                return redirect()->back()->with('error','These credentials do not match our records.');
            }
     }
    //  function for login with google 
     public function redirectToProvider($driver)
     {         
         return Socialite::driver($driver)->redirect();
     } 
     public function handleGoogleCallback()
     {
         try {
     
             $user = Socialite::driver('google')->stateless()->user(); 
             $google_user_id = $user->id;
             $finduser = User::where('google_id', $user->id)->first();
      
             if($finduser){
      
                 Auth::login($finduser);
                 return redirect('/');
      
             }else{
                $finduser = User::where('email',$user->email)->first();
                if($finduser)
                {
                    Auth::login($finduser);
                    return redirect('/');
                }
                else
                {
                    $newUser = new User();
                    $newUser->name = $user->name;
                    $newUser->lname = $user->name;
                    $newUser->email = $user->email;
                    $newUser->dob = date('Y-m-d');
                    $newUser->password = Hash::make('123456dummy');
                    $newUser->google_id = $google_user_id;
                    $newUser->status = 1;
                    $newUser->save(); 
                   
                     Auth::login($newUser);                    
                     return redirect('/');
                }
                
             }
     
         } catch (Exception $e) {
             Log::info($e->getMessage());    
             return redirect()->back()->with('error',$e->getMessage());
             // dd($e->getMessage());
         }
     }
     // end  function for login with google 
     //function run when user click the link send on register email
     public function activation($uid)
     {
        $user_id = base64_decode($uid);        
         $user = User::find($user_id);
         //active the particular user
         $user->status = 1;
         $user->save();
         Auth::login($user);
         return redirect(RouteServiceProvider::HOME);
         
     }
     //account detail and update function
     public function myaccount()
     {
        if (Auth::check()) {
            // The user is logged in...                      
            return view('website.pages.myaccount');
        }
        else
        {
            return redirect('/');
        }
     }
     public function update_account (Request $request)
     {
            // The user is logged in...        
            $request_data = $request->all();
         
            $messages = [
                'name.required' => 'Please enter first name',
                'lname.required' => 'Please enter last name',                
                'dob.required' => 'Please enter date of birth',      
    
            ];
            $validator = Validator::make($request_data, [       
                'name' => 'required|string|max:255',
                'lname' => 'required|string|max:255',              
                'dob'=>'required'
            ],$messages);
    
            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Validation Error')->withErrors($validator)->withInput();
            } 
            else { 
                   try
                   {
                       Log::info('in try');
                        DB::beginTransaction();
                        $user = Auth::user();
                         
                        $user->name = $request->name;
                        $user->lname = $request->lname;
                        $user->dob = $request->dob;                         
                        $user->is_newsletter = (isset($request->is_newsletter))?1:0;
                        $user->save();
                        DB::commit();
                     
                        return redirect()->back()->with('success','User detail updated successfully.');
                        
                       
                   }
                   catch(Exception $e) {
                        DB::rollBack();
                        return redirect()->back()->with('error','Some thing wen wrong');
                    }    
                }
     }
}
