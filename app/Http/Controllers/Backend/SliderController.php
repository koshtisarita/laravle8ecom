<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Validator;
use DB;

class SliderController extends Controller
{ 
     /*------------- adding slider into the database ----*/
     public function store(Request $request)
    {
        $request_data = $request->all();
      
         //Aliases
        $messages = [
            'title.required' =>'Please enter a Title',
            'sub_title.required' =>'Please enter a Sub Title',
            'image.required' =>'Please upload a Image', 
        ];
        $validator = Validator::make($request_data,
        [
            'title' =>'required',
            'sub_title' =>'required',
            'image' =>'required' 
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
                $image=$request->file('image');
                $name_gen=hexdec(uniqid()).".".$image->getClientOriginalExtension();
                Image::make($image)->resize(1920,930)->save('upload/slider/'.$name_gen);
                $save_url='upload/slider/'.$name_gen;

                /** Now save all data to db */
               $slider = new Slider();
               $slider->title = ucfirst($this->clean_input($request->title));
               $slider->sub_title = ucfirst($this->clean_input($request->sub_title));
               $slider->image_path = $save_url;
               $slider->hyperlink = isset($request->hyperlink)?$request->hyperlink:"";
               $slider->save();

              
                DB::commit(); 
                return redirect()->back()->with('success','Slider added successfully');   

            }
            catch(Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error','Some thing wen wrong');
            }

        }    
    }
    /*------------ delete  slider  -----*/
    public function destroy(Slider $slider)
    {
        
        $image=$slider->image_path;
        unlink($image);
        //dd($brand);
        $slider->delete();
        
        return redirect()->back()->with('success','Slider deleted successfully');
    }
    /*------------show the slidet information -----*/
    public function edit(Slider $slider)
    {  
        
        if($slider){            
            $response = [
                'result'=>1,
                'id' => $slider->id,
                'title' =>htmlspecialchars_decode($slider->title),
                'sub_title'=>htmlspecialchars_decode($slider->sub_title),
                'hyperlink'=>$slider->hyperlink,
                // 'slider'=>$slider
            ];             
        }
        else
        {     $response = ['result'=>0];  }
        return $response;
    }  
    /*------------update slider data -----*/
    public function update(Request $request)
    {
        $request_data = $request->all();
         //Aliases
         $messages = [
            'title.required' =>'Please enter a Title',
            'sub_title.required' =>'Please enter a Sub Title', 
        ];
        $validator = Validator::make($request_data,
        [
            'title' =>'required',
            'sub_title' =>'required', 
        ],$messages);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation error occure in editing data') 
            ->withErrors($validator)->withInput();
        }        
        else
         {  
            $slider = Slider::find($request->slider_id);
            
            if($slider)
            {
                
                $old_image=$slider->image_path; //path to the image
                /*------if user has uploaded a pic---------*/
                if($request->file('image')){

                    unlink($old_image);
                    $image=$request->file('image');
                    $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(1920,930)->save('upload/slider/'.$name_gen);
                    $save_url='upload/slider/'.$name_gen;
                    $slider->update([
                        'title'=>ucfirst($this->clean_input($request->title)), 
                        'sub_title'=> ucfirst($this->clean_input($request->sub_title)),
                        'hyperlink'=> ($request->hyperlink!=""?$request->hyperlink:""),
                        'image_path' =>$save_url
                    ]);
                    
                    // $brands=Brand::latest()->get(); 
                    return redirect()->back()->with('success','Slider edited successfully');
                }  
                else{ //ie if image not uploaded
                    $slider->update([
                        'title'=>ucfirst($this->clean_input($request->title)), 
                        'sub_title'=> ucfirst($this->clean_input($request->sub_title)),
                        'hyperlink'=> ($request->hyperlink!=""?$request->hyperlink:""), 
                    ]);
                    // $brands=Brand::latest()->get(); 
                    // return view('admin.masters.viewbrand',compact('brands'))->with('success','Brand edited successfully');
                    return redirect()->back()->with('success','slider edited successfully');
                } 
                
            }
            else
            {
                return redirect()->back()->with('error','No record found');
            }

        }
         
    }
    /*----------- active, inactive slider with this command -----*/
    public function update_status(Slider $slider)
    {
         if($slider->status == 1)
         {
             $slider->status = 0;
             $msg = "Slider de-activated successfully";
         }             
          else
          {
               $slider->status = 1; 
               $msg = "Slider activated successfully";
          }
            
        $slider->save();        
        return redirect()->back()->with('success',$msg);
    }

    public function clean_input($text)
    {
         $text = trim($text);
         $text = htmlspecialchars($text);
         return $text;
    }
}
