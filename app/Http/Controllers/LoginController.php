<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Log;
use Hash;

class LoginController extends Controller
{
    

    public function store(Request $request)
    {
        
        Log::info($request->all);
        
                    
       
        
    }
}
