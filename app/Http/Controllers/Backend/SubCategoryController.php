<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_Category;
use App\Models\Category;
use Image;
use Validator;
use DB;
use Session;

class SubCategoryController extends Controller
{
        //view the categories saved in db
        public function viewsubcategory()
        {
           $subcategories= Sub_Category::latest()->get();
           $categories= Category::latest()->get();
           
           if(Session::has('success'))
           { 
               Alert::success('Success!',Session::get('success'));
           }
           if(Session::has('error'))
           {            
               Alert::error('Error',Session::get('error'));
           }
           return view('admin.masters.subcategory',compact('categories'));
        }
   
        /**************Store data ********/
       public function store(Request $request)
       {
           $request_data = $request->all();
           //Aliases
          $messages = [
              'name.required'=>'Please enter Category Name', 
          ];
          $validator = Validator::make($request_data, [         
              'name'=>'required', 
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
                  $today_date = date('Y-m-d h:i:s');
                  Category:: insert([
                      'name'=>ucfirst($request->name),
                      'created_at'=>  $today_date,
                      'updated_at' =>$today_date
                  ]);
   
                  DB::commit();                 
                  return redirect()->route('viewcategory')->with('success','Category added successfully');  
               }
               catch(Exception $e) {
                   DB::rollBack();
                   return redirect()->route('viewcategory')->with('error','Some thing wen wrong');
               }
   
           }    
    
       }
   
       /***** get data for update  */
       public function edit(Category $category)
       {
           if($category){        
               $response = [
                   'result'=>1,
                   'category'=>$category
               ];             
           }
           else
           {
               $response = ['result'=>0];
   
           }
           return $response;
       }
   
       /*********update category *********/ 
       public function update(Request $request)
       {
           $request_data = $request->all();
           //Aliases
          $messages = [
              'name.required'=>'Please enter Category Name', 
          ];
          $validator = Validator::make($request_data, [         
              'name'=>'required', 
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
                  $category = Category::find($request->id);              
                  $category->name = $request->name;
                  $category->save();
                  
                  DB::commit();                 
                  return redirect()->route('viewcategory')->with('success','Category updated successfully');  
               }
               catch(Exception $e) {
                   DB::rollBack();
                   return redirect()->route('viewcategory')->with('error','Some thing wen wrong');
               }
   
           }    
       }
       /******************** Delete the category  ***********/
       public function destroy(Category $category)
       {    
           $category->delete();        
           return redirect()->back()->with('deletemessage','Category deleted successfully');
       }
}
