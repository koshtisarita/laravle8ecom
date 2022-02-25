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
use RealRashid\SweetAlert\Facades\Alert;

class SubCategoryController extends Controller
{
        //view the categories saved in db
        public function viewsubcategory()
        {
           $subcategories= Sub_Category::latest()->get();
           $categories= Category::latest()->get()->keyBy('id');
          
           if(Session::has('success'))
           { 
               Alert::success('Success!',Session::get('success'));
           }
           if(Session::has('error'))
           {            
               Alert::error('Error',Session::get('error'));
           }
           return view('admin.masters.subcategory',compact('categories','subcategories'));
        }
   
        /**************Store data ********/
       public function store(Request $request)
       {
           $request_data = $request->all();
          
           //Aliases
          $messages = [
              'category_id.required'=>'Please enter Category Name', 
              'name.required'=>'Please enter Sub-Category Name', 
              'description.required'=>'Please enter Category Description', 
          ];
          $validator = Validator::make($request_data, [  
              'category_id'=>'required',        
              'name'=>'required', 
              'description'=>'required', 
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
                  Sub_Category:: insert([
                       'category_id'=>$request->category_id,
                      'name'=>ucfirst($request->name),
                      'description'=>$this->clean_input($request->description),
                      'seo_title'=>$this->clean_input($request->seo_title),
                      'seo_keyword'=>$this->clean_input($request->seo_keywords),
                      'seo_description'=>$this->clean_input($request->seo_description),
                      'created_at'=>  $today_date,
                      'updated_at' =>$today_date
                  ]);
   
                  DB::commit();                 
                  return redirect()->route('viewsubcategory')->with('success','Sub-Category added successfully');  
               }
               catch(Exception $e) {
                   DB::rollBack();
                   return redirect()->route('viewsubcategory')->with('error','Some thing wen wrong');
               }
   
           }    
    
       }
   
       /***** get data for update  */
       public function edit(Sub_Category $subcategory)
       {
           if($subcategory){        
               $response = [
                   'result'=>1,
                   'category'=>$subcategory
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
            'category_id.required'=>'Please enter Category Name', 
            'name.required'=>'Please enter Sub-Category Name', 
            'description.required'=>'Please enter Category Description', 
        ];
        $validator = Validator::make($request_data, [  
            'category_id'=>'required',        
            'name'=>'required', 
            'description'=>'required', 
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
                  $subcategory = Sub_Category::find($request->id);
                 
                  $subcategory->category_id = $request->category_id;
                  $subcategory->name = ucfirst($request->name);
                  $subcategory->description = $this->clean_input($request->description);
                  $subcategory->seo_title = $this->clean_input($request->seo_title);
                  $subcategory->seo_keyword = $this->clean_input($request->seo_keywords);
                  $subcategory->seo_description = $this->clean_input($request->seo_description);  
                  $subcategory->save();
                  
                  DB::commit();                 
                  return redirect()->route('viewsubcategory')->with('success','Sub-Category updated successfully');  
               }
               catch(Exception $e) {
                   DB::rollBack();
                   return redirect()->route('viewsubcategory')->with('error','Some thing wen wrong');
               }
   
           }    
       }
       /******************** Delete the category  ***********/
       public function destroy(Sub_Category $subcategory)
       {    
           $subcategory->delete();        
           return redirect()->back()->with('deletemessage','SunCategory deleted successfully');
       }
       public function clean_input($text)
       {
            $text = trim($text);
            $text = htmlspecialchars($text);
            return $text;
       }
}
