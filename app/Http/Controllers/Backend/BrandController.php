<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;
use Validator;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
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
   
  /*-------------- add data-------------*/
    public function store(Request $request)
    {
        $request_data = $request->all();
         //Aliases
        $messages = [
            'brand_name.required'=>'Please enter Brand Name',
            'brand_image.required'=>'Please upload a Brand Image',
            'brand_short_desc.required'=>'Please add a short Decsription'
        ];
        $validator = Validator::make($request_data, [
          
            'brand_name'=>'required',
            'brand_image'=>'required',
            'brand_short_desc'=>'required',
        ],$messages);
       
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation error occure in adding data') 
            ->withErrors($validator)->withInput();
        } 
        else
         { 
            try
            {
                DB::beginTransaction();
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
                DB::commit();
               
                return redirect()->route('viewbrand')->with('success','Brand added successfully');   

            }
            catch(Exception $e) {
                DB::rollBack();
                return redirect()->route('viewbrand')->with('error','Some thing wen wrong');
            }

        }    
    }
   
    /*------------show edit form--------------*/

    public function edit(Brand $brand)
    {  
        
        if($brand){
            // $flag ="edit";            
            // return view('admin.masters.viewbrand',compact('brand','flag'));            
            $response = [
                'result'=>1,
                'brand'=>$brand
            ];             
        }
        else
        {
            $response = ['result'=>0];

        }
        return $response;
    }   
    /*--------------update brand data-----------------*/

    public function update(Request $request)
    {
        $request_data = $request->all();
        $messages = [ 
            'brand_name.required'=>'Please enter Brand Name', 
            'brand_short_desc.required'=>'Please add a short Decsription'
        ];
        
        $validator = Validator::make($request_data, [
            'brand_name'=>'required', 
            'brand_short_desc'=>'required',
        ],$messages);
        //Aliases
        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Validation error occure in updating data') 
            ->withErrors($validator)->withInput();
        } 
        else
         {  
            $brand = Brand::find($request->brand_id);
            
            if($brand)
            {
                
                $old_image=$brand->brand_image; //path to the image
                /*------if user has uploaded a pic---------*/
                if($request->file('brand_image')){

                    unlink($old_image);
                    $image=$request->file('brand_image');
                    $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
                    $save_url='upload/brand/'.$name_gen;
                    $brand->update([
                        'brand_name'=>$request->brand_name,
                        // 'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
                        'brand_image'=>$save_url,
                        'brand_short_desc'=>$request->brand_short_desc,
                    ]);
                    
                    // $brands=Brand::latest()->get(); 
                    return redirect()->route('viewbrand')->with('success','Brand edited successfully');
                }  
                else{ //ie if image not uploaded
                    $brand->update([
                        'brand_name'=>$request->brand_name,
                        'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
                        'brand_short_desc'=>$request->brand_short_desc,
                    ]);
                    // $brands=Brand::latest()->get(); 
                    // return view('admin.masters.viewbrand',compact('brands'))->with('success','Brand edited successfully');
                  
                    return redirect()->route('viewbrand')->with('success','Brand edited successfully');
                } 
                
            }
            else
            {
                return redirect()->route('viewbrand')->with('error','No record found');
            }

        }
         
    }
    // public function update1(Request $request, Brand $brand)
    // {
    //     $old_image=$request->old_image; //path to the image
    //     /*------if user has uploaded a pic---------*/
    //     if($request->file('brand_image')){
    //         unlink($old_image);
    //         $image=$request->file('brand_image');
    //         $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    //         Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
    //         $save_url='upload/brand/'.$name_gen;
    //         $brand->update([
    //             'brand_name'=>$request->brand_name,
    //             'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
    //             'brand_image'=>$save_url,
    //             'brand_short_desc'=>$request->brand_short_desc,
    //         ]);
             
    //         return redirect()->back()->with('editmessage','Brand edited successfully');
    //     }  
    //     else{ //ie if image not uploaded
    //         $brand->update([
    //             'brand_name'=>$request->brand_name,
    //             'brand_name_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
    //             'brand_short_desc'=>$request->brand_short_desc,
    //         ]); 
    //         return redirect()->back()->with('editmessage','Brand edited successfully');
    //     }     
    // }
    /*---------------------- delete brand data--------------------*/
    public function destroy(Brand $brand)
    {
        
        $image=$brand->brand_image;

        unlink($image);
        //dd($brand);
        $brand->delete();        
        return redirect()->back()->with('deletemessage','Brand deleted successfully');
    }
}
