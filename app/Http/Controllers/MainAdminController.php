<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Size;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Log;


class MainAdminController extends Controller
{
    public function dashboard()
    {
         return view('admin.dashboard');
    }

    //master menu function
   
  
    public function viewsetting()
    {
        return view('admin.masters.viewsetting');
    }

   
}
