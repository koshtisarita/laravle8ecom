<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;  
use Validator;
use DB;
use Session;
use Image;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    //view the categories saved in db
     public function viewcategory()
     {
        $categories= Category::latest()->get();
        
        if(Session::has('success'))
        { 
            Alert::success('Success!',Session::get('success'));
        }
        if(Session::has('error'))
        {            
            Alert::error('Error',Session::get('error'));
        }
        return view('admin.masters.category',compact('categories'));
     }

     /**************Store data ********/
    public function store(Request $request)
    {
        $request_data = $request->all();
        //Aliases
       $messages = [
           'name.required'=>'Please enter Category Name', 
           'image.required'=>'Please upload a image',
           'image.mimes'=>'Invalid file format'
       ];
       $validator = Validator::make($request_data, [         
           'name'=>'required', 
           'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
               $image=$request->file('image');
               $name_gen=hexdec(uniqid()).".".$image->getClientOriginalExtension();
               Image::make($image)->resize(600,400)->save('upload/category/'.$name_gen);
               $save_url='upload/category/'.$name_gen;

               $today_date = date('Y-m-d h:i:s');
               Category:: insert([
                   'name'=>ucfirst($request->name),
                   'image_path'=>$save_url,
                   'link'=>trim($request->ref_link),
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
           'image.mimes'=>'Invalid file format'
       ];
       if($request->file('image'))
       {
            $validator = Validator::make($request_data, [         
                'name'=>'required', 
                'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],$messages);
       }
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
               if($category)
               {                   
                  $old_image=$category->image_path; //path to the image
                  if($request->file('image'))
                   {
                        unlink($old_image);
                        $image=$request->file('image');
                        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                        Image::make($image)->resize(600,400)->save('upload/category/'.$name_gen);
                        $save_url='upload/category/'.$name_gen;  
                        $category->image_path = $save_url;  //image path set                  
                
                    }
                  $category->name = $request->name;
                  $category->link = trim($request->ref_link);
                  $category->save();
                  DB::commit();                 
                  return redirect()->route('viewcategory')->with('success','Category updated successfully');
                 
               }
               else
               {
                return redirect()->route('viewcategory')->with('erroe','No Data Found');
               }  
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
