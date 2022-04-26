<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Validator;
use DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;


class ColorController extends Controller
{
    public function viewcolor()
    {
        $colors= Color::latest()->get();
        if(Session::has('success'))
        { 
            Alert::success('Success!',Session::get('success'));
        }
        if(Session::has('error'))
        {            
            Alert::error('Error',Session::get('error'));
        }
        return view('admin.masters.viewcolor',compact('colors'));
    }
    /*-------------- add data-------------*/
    public function store(Request $request)
    {
        $request_data = $request->all();
         //Aliases
        $messages = [
            'name.required'=>'Please enter Color Name',
            'code.required'=>'Please enter hexadecimal code',
         

        ];
        $validator = Validator::make($request_data, [
          
            'name'=>'required',
            'code'=>'required',
        
        ],$messages);
       
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation error occure in adding data') 
            ->withErrors($validator)->withInput();
        } 
        else
         { 
            //  dd($request_data);
            try
            {
                DB::beginTransaction();
                $today_date = date('Y-m-d h:i:s');

                /** Now save all data to db */
                Color:: insert([
                    'name'=>$request->name,
                    'color_code'=>trim($request->code), //search, replace,subject
                   
                ]); 
                DB::commit();
               
                return redirect()->route('viewcolor')->with('success','Color added successfully');   

            }
            catch(Exception $e) {
                DB::rollBack();
                return redirect()->route('viewsize')->with('error','Some thing wen wrong');
            }

        }    
    }
      /*------------show edit form--------------*/

      public function edit(Color $color)
      {  
          
          if($color){
              // $flag ="edit";            
              // return view('admin.masters.viewbrand',compact('brand','flag'));            
              $response = [
                  'result'=>1,
                  'color'=>$color
              ];             
          }
          else
          {
              $response = ['result'=>0];
  
          }
          return $response;
      } 

        /*---------- update the size data --------------*/
      public function update(Request $request)
      {
        $request_data = $request->all();
        //Aliases
       $messages = [
           'name.required'=>'Please enter Color Name',
           'code.required'=>'Please enter hexadecimal code',
        

       ];
       $validator = Validator::make($request_data, [
         
           'name'=>'required',
           'code'=>'required',
       
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
                    $color = Color::find($request->color_id);
                    if($color)
                    {
                        $color->name = $request->name; 
                        $color->color_code = trim($request->code);
                        
                        $color->update();
                        DB::commit();
               
                        return redirect()->route('viewcolor')->with('success','Color detail updated successfully');  
                    }
                    else
                    {
                        return redirect()->route('viewcolor')->with('error','No record found');
                    }
                     
    
                }
                catch(Exception $e) {
                    DB::rollBack();
                    return redirect()->route('viewcolor')->with('error','Some thing wen wrong');
                }
  
          }
           
      }  

         /*---------------------- delete Color data--------------------*/
    public function destroy(Color $color)
    {
        $color->delete();        
        return redirect()->back()->with('deletemessage','Color deleted successfully');
    }
}
