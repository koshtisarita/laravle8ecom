<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Size;
use Validator;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class SizeController extends Controller
{
    /*-------------- add data-------------*/
    public function store(Request $request)
    {
        $request_data = $request->all();
         //Aliases
        $messages = [
            'size_no.required'=>'Please enter Size Number',
            'size_shortcut.required'=>'Please enter Size Shortcut. (ex- S, M, L, XL)',
            'waist_size.required'=>'Please enter Waist Size',
            'hip_size.required'=>'Please enter Hip Size',
            'chest_size.required'=>'Please enter Chest Size',
            'size_no.numeric'=>'Size number should be in digit',
            'waist_size.numeric'=>'Waist Size should be in digit',
            'hip_size.numeric'=>'Hip Size should be in digit',
            'chest_size.numeric'=>'Chest Size should be in digit',

        ];
        $validator = Validator::make($request_data, [
          
            'size_no'=>'required|numeric',
            'size_shortcut'=>'required',
            'waist_size'=>'required|numeric',
            'hip_size'=>'required|numeric',
            'chest_size'=>'required|numeric',
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
                SIze:: insert([
                    'size_no'=>$request->size_no,
                    'size_shortcut'=>strtoupper($request->size_shortcut), //search, replace,subject
                    'waist_size'=>$request->waist_size,
                    'hip_size'=>$request->hip_size,
                    'chest_size'=>$request->chest_size,
                    'created_at'=>$today_date,
                    'updated_at'=>$today_date,
                ]); 
                DB::commit();
               
                return redirect()->route('viewsize')->with('success','Size added successfully');   

            }
            catch(Exception $e) {
                DB::rollBack();
                return redirect()->route('viewsize')->with('error','Some thing wen wrong');
            }

        }    
    }
      /*------------show edit form--------------*/

      public function edit(Size $size)
      {  
          
          if($size){
              // $flag ="edit";            
              // return view('admin.masters.viewbrand',compact('brand','flag'));            
              $response = [
                  'result'=>1,
                  'size'=>$size
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
                'size_no.required'=>'Please enter Size Number',
                'size_shortcut.required'=>'Please enter Size Shortcut. (ex- S, M, L, XL)',
                'waist_size.required'=>'Please enter Waist Size',
                'hip_size.required'=>'Please enter Hip Size',
                'chest_size.required'=>'Please enter Chest Size',
                'size_no.numeric'=>'Size number should be in digit',
                'waist_size.numeric'=>'Waist Size should be in digit',
                'hip_size.numeric'=>'Hip Size should be in digit',
                'chest_size.numeric'=>'Chest Size should be in digit',

            ];
            $validator = Validator::make($request_data, [
                
                'size_no'=>'required|numeric',
                'size_shortcut'=>'required',
                'waist_size'=>'required|numeric',
                'hip_size'=>'required|numeric',
                'chest_size'=>'required|numeric',
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
                    $size = Size::find($request->size_id);
                    if($size)
                    {
                        $size->size_no = $request->size_no; 
                        $size->size_shortcut = strtoupper($request->size_shortcut);
                        $size->waist_size = $request->waist_size;
                        $size->hip_size = $request->hip_size;
                        $size->chest_size = $request->chest_size;
                        $size->update();
                        DB::commit();
               
                        return redirect()->route('viewsize')->with('success','Size updated successfully');  
                    }
                    else
                    {
                        return redirect()->route('viewsize')->with('error','No record found');
                    }
                     
    
                }
                catch(Exception $e) {
                    DB::rollBack();
                    return redirect()->route('viewsize')->with('error','Some thing wen wrong');
                }
  
          }
           
      }  

         /*---------------------- delete size data--------------------*/
    public function destroy(Size $size)
    {
        $size->delete();        
        return redirect()->back()->with('deletemessage','Size deleted successfully');
    }
}