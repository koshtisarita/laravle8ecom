<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{



  /*-------------- add data-------------*/
    public function store(Request $request)
    {
        
        $request->validate([
            'brand_name'=>'required',
            'brand_image'=>'required',
            'brand_short_desc'=>'required',
        ],
        //Aliases
        [
            'brand_name.required'=>'Please enter Brand Name',
            'brand_image.required'=>'Please upload a Brand Image',
            'brand_short_desc.required'=>'Please add a short Decsription'
        ]);

        /** For Resizing Image */
        $image=$request->file('brand_image');
        $name_gen=hexdec(uniqid()).".".$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url='upload/brand/'.$name_gen;

        /** Now save all data to db */
        Brand:: insert([
            'brand_name'=>$request->brand_name,
            'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)), //search, replace,subject
            'brand_image'=>$save_url,
            'brand_short_desc'=>$request->brand_short_desc,
        ]); 
        $brands=Brand::latest()->get(); 
        return view('admin.masters.viewbrand',compact('brands'))->with('addmessage','Brand added successfully');   
    }

 
    /*------------show edit form--------------*/

    public function edit(Brand $brand)
    {  
        if($brand){
            return view('admin.brand.editbrand',compact('brand'));
        }
    }

   
    /*--------------update brand data-----------------*/

    public function update(Request $request, Brand $brand)
    {
        $old_image=$request->old_image; //path to the image
        /*------if user has uploaded a pic---------*/
        if($request->file('brand_image')){
            unlink($old_image);
            $image=$request->file('brand_image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url='upload/brand/'.$name_gen;
            $brand->update([
                'brand_name'=>$request->brand_name,
                'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
                'brand_image'=>$save_url,
                'brand_short_desc'=>$request->brand_short_desc,
            ]);
            
            $brands=Brand::latest()->get(); 
            return view('admin.masters.viewbrand',compact('brands'))->with('editmessage','Brand edited successfully');
        }  
        else{ //ie if image not uploaded
            $brand->update([
                'brand_name'=>$request->brand_name,
                'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
                'brand_short_desc'=>$request->brand_short_desc,
            ]);
            $brands=Brand::latest()->get(); 
            return view('admin.masters.viewbrand',compact('brands'))->with('editmessage','Brand edited successfully');
        }     
    }
    /*---------------------- delete brand data--------------------*/
    public function destroy(Brand $brand)
    {
        
        $image=$brand->brand_image;
        unlink($image);
        //dd($brand);
        $brand->delete();
        
        return view('admin.masters.viewbrand',compact('brands'))->with('deletemessage','Brand deleted successfully');
    }
}
