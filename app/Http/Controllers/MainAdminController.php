<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainAdminController extends Controller
{
    public function dashboard()
    {
         return view('admin.dashboard');
    }

    //master menu function
    public function viewbrand()
    {
        return view('admin.masters.viewbrand');
    }
    public function viewsize()
    {
        return view('admin.masters.viewsize');
    }
    public function viewpincode()
    {
        return view('admin.masters.viewpincode');
    }
    public function viewsetting()
    {
        return view('admin.masters.viewsetting');
    }
}
