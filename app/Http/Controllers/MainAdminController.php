<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Slider;
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
    public function viewbrand()
    {
        
        $brands= Brand::latest()->get();
         if(Session::has('success'))
         { 
             Alert::success('Success!',Session::get('success'));
         }
         if(Session::has('error'))
         {            
             Alert::error('Error',Session::get('error'));
         }
        return view('admin.masters.viewbrand',compact('brands'));
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

    public function viewslider()
    {
        $sliders= Slider::latest()->get();
        if(Session::has('success'))
        { 
            Alert::success('Success!',Session::get('success'));
        }
        if(Session::has('error'))
        {            
            Alert::error('Error',Session::get('error'));
        }
        return view('admin.masters.slider',compact('sliders'));
    }
}
