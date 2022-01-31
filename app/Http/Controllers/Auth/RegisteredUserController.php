<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
         
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
            'dob'=>['require']
        ]);

        $user = User::create([
            'name' => $request->name,
            'name' => $request->lname,
            'dob' => $request->dob,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_newsletter' => ($request->is_newsletter=='on')?1:0,
        ]);

        event(new Registered($user));

        Auth::login($user);
         
        if($user->role_id == 1)
            return redirect(RouteServiceProvider::HOME);
        else
            return redirect(RouteServiceProvider::ADMIN);
               
    }
}