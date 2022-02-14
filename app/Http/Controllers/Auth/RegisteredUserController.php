<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
use DB;
use Log;
// use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        Log::info($request_data);
        $messages = [
            'name.required' => 'Please enter first name',
            'lname.required' => 'Please enter last name',
            'remail.required' => 'Please enter email address',
            'remail.unique'=>'This email address already taken',
            'rpassword.required' => 'Please enter password',
            'rpassword_confirmation.required' => 'Please enter confirm password',
            'rpassword.same' => 'The confirm password and password must match',
            'dob.required' => 'Please enter date of birth',      

        ];
        $validator = Validator::make($request_data, [       
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'remail' => 'required|email|max:255|unique:users',
            'rpassword' => 'required|min:8',
            'rpassword_confirmation' => 'required|min:8|same:rpassword',
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
                    $user = User::create([
                        'name' => $request->name,
                        'lname' => $request->lname,
                        'dob' => $request->dob,
                        'email' => $request->remail,
                        'role_id'=>1,
                        'password' => Hash::make($request->password),
                        'is_newsletter' => (isset($request->is_newsletter)?1:0),
                    ]);

                      event(new Registered($user));

                    //Auth::login($user);//activation pending
                    Log::info('user saved');
                   
                    $email= trim($user->email);
                    $name =   $user->name.' '.$user->lname;         
                    $data = array(
                        'user_name' => $name,
                        'id' => $user->id
                    );
                    //return redirect(RouteServiceProvider::HOME);
                    

                    Mail::send('website.emails.activation', array('data' => $data), function ($message) use ($email, $name) {
                        $message->to($email, $name)->subject('Hire Dress :: Account Activation');
                    });
                     
                    DB::commit();
                     
                    return redirect()->back()->with('success','User register successfully.To active your account please check register email account');
                    
                   
               }
               catch(Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with('error','Some thing wen wrong');
                }
                
           }       
    }
}
