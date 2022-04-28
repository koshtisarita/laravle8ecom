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
use App\Models\Size;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Validator;
use Illuminate\Support\Facades\DB;
class MainWebController extends Controller
{
     public function index(){

        $setting=DB::table('sitesettings')->first();
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

         return view('website.pages.index',compact('sliders','categories','sizes','new_arrival','most_popular','most_viewed','setting'));
        }
     

    /*** contact us */  
    
     public function contactus(){
        //$setting=DB::table('sitesettings')->first();
        //added directly into the contact us page
          return view('website.pages.contactus');
     }

    /*--------end of contact us **/


     public function aboutus(){ 
         return view('website.pages.aboutus');
    }
     public function cart(){return view('website.pages.cart');}
     public function product_list(){return view('website.pages.productlist');}
     public function product_detail(){return view('website.pages.productdetail');}

     public function loginpage(){
        $setting=DB::table('sitesettings')->first();
         return view('website.pages.login_registration',compact('setting'))
         
    ;}


    
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
