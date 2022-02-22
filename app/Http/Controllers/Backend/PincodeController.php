<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;
use Validator;
use DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;


class PincodeController extends Controller
{
    public function viewpincode()
    {
        $pincodes= Pincode::latest()->get();
        if(Session::has('success'))
        { 
            Alert::success('Success!',Session::get('success'));
        }
        if(Session::has('error'))
        {            
            Alert::error('Error',Session::get('error'));
        }
        return view('admin.masters.viewpincode',compact('pincodes'));
    }
      /*-------------- add data-------------*/
      public function store(Request $request)
      {
          $request_data = $request->all();
           //Aliases
          $messages = [
              'pincode.required'=>'Please enter Pincode',
             ];
          $validator = Validator::make($request_data, [
            
              'pincode'=>'required|min:6|max:7', 
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
                  pincode:: insert([
                      'pincode'=>$request->pincode,
                      'created_at'=>  $today_date,
                      'updated_at' =>$today_date
                  ]); 
                  DB::commit();                 
                  return redirect()->route('viewpincode')->with('success','Pincode added successfully');   
  
              }
              catch(Exception $e) {
                  DB::rollBack();
                  return redirect()->route('viewpincode')->with('error','Some thing wen wrong');
              }
  
          }    
      }
       /*----------- active, inactive slider with this command -----*/
    public function update_status(Pincode $pincode)
    {
         if($pincode->status == 1)
         {
             $pincode->status = 0;
             $msg = "Pincode de-activated successfully";
         }             
          else
          {
               $pincode->status = 1; 
               $msg = "Pincode activated successfully";
          }
            
        $pincode->save();        
        return redirect()->route('viewpincode')->with('success',$msg);
    }

  
           /*---------------------- delete pincode data--------------------*/
      public function destroy(Pincode $pincode)
      {
          $pincode->delete();        
          return redirect()->back()->with('deletemessage','Pincode deleted successfully');
      }
}
