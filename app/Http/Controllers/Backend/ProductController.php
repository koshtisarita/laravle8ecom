<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Category;
use Image;
use Validator;
use DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function newproduct()
    {
        if(Session::has('success'))
        { 
            Alert::success('Success!',Session::get('success'));
        }
        if(Session::has('error'))
        {            
            Alert::error('Error',Session::get('error'));
        }
        return view('admin.product.newproduct');
    }
}
