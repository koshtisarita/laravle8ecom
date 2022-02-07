<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Log;
use Hash;

class MainWebController extends Controller
{
     public function index()
     {
         return view('website.pages.index');
     }
     public function contactus()
     {
         return view('website.pages.contactus');
     }
     public function aboutus()
     {
         return view('website.pages.aboutus');
     }
     public function cart()
     {
         return view('website.pages.cart');
     }
     public function product_list()
     {
         return view('website.pages.productlist');
     }
     public function product_detail()
     {
         return view('website.pages.productdetail');
     }
     public function loginpage()
     {
         return view('website.pages.login_registration');
     }
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
                            // return redirect()->intended(RouteServiceProvider::ADMIN);
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
     
}
