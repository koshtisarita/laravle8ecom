<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Sub_Category;
use App\Models\Size;
use App\Models\ProductImage;
use Carbon\Carbon;
use Image;
use Validator;
use DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use Log;
use File;

class ProductController extends Controller
{
    public $stepCounter;

    public function _constructor()
    {
        $this->stepCounter = 1;
    }
    public function viewproduct()
    {
        $products = Product::latest()->get();
        if(Session::has('success'))
        { 
            Alert::success('Success!',Session::get('success'));
        }
        if(Session::has('error'))
        {            
            Alert::error('Error',Session::get('error'));
        }
        return view('admin.product.viewproduct',compact('products'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function createStepOne()
    {
       
                
        $brands = Brand::all();
        $sizes = Size::all();
        $categories = Category::all();
        $sub_categories = Sub_Category::all()->KeyBy('id');

        return view('admin.product.add',compact('brands','sizes','categories','sub_categories'));
    }
  
    public function postStepOne(Request $request)
    {
        
        if(isset($request->is_discount) && $request->is_discount =='1' && $request->is_discount != null)
        {
            $messages = [ 
                'title.required'=>'Please enter Product Title', 
                'subtitle.required'=>'Please enter Product Subtitle',
                'slug.required'=>'Please enter Product SLUG',
                'short_description.required'=>'Please enter Product Short Description',
                'long_description.required'=>'Please enter Product Long Description',
                'actual_price.required'=>'Please enter Product Price',
                'is_discount.required'=>'Please select Discount option',
                'discount.required'=>'Please enter any value in discount',
                'discount_in.required'=>'Please select Discount in option',
                'status.required'=>'Please select Product Status', 
                'length.required'=>'Please select Product Length',
                'size_id.required'=>'Please select Product Size',
                'brand_id.required'=>'Please select Product Brand',
                'categories.required'=>'Please enter Product Category',
                'sub_categories.required'=>'Please enter Product Sub-Category', 
            ];
            
            $validator = Validator::make($request->all(),[ 
                'title' => 'required|unique:products',
                'subtitle' => 'required',
                'slug' => 'required|unique:products',
                'short_description'=>'required',
                'long_description'=>'required',
                'actual_price'=>'required',
                'is_discount'=>'required',
                'discount'=>'required|numeric',
                'discount_in'=>'required',
                'status' => 'required',           
                'length' => 'required',
                'size_id'=>'required',
                'brand_id'=>'required',
                'categories'=>'required',
                'sub_categories'=>'required', 
            ],$messages);
        }
        else
        {
            $messages = [ 
                'title.required'=>'Please enter Product Title', 
                'subtitle.required'=>'Please enter Product Subtitle',
                'slug.required'=>'Please enter Product SLUG',
                'short_description.required'=>'Please enter Product Short Description',
                'long_description.required'=>'Please enter Product Long Description',
                'actual_price.required'=>'Please enter Product Price',
                'is_discount.required'=>'Please select Discount option',
                'status.required'=>'Please select Product Status', 
                'length.required'=>'Please select Product Length',
                'size_id.required'=>'Please select Product Size',
                'brand_id.required'=>'Please select Product Brand',
                'categories.required'=>'Please enter Product Category',
                'sub_categories.required'=>'Please enter Product Sub-Category', 
                
            ];
            
            $validator = Validator::make($request->all(),[ 
                'title' => 'required|unique:products',
                'subtitle' => 'required',
                'slug' => 'required|unique:products',
                'short_description'=>'required',
                'long_description'=>'required',
                'actual_price'=>'required',
                'is_discount'=>'required',
                'status' => 'required',           
                'length' => 'required',
                'size_id'=>'required',
                'brand_id'=>'required',
                'categories'=>'required',
                'sub_categories'=>'required', 
                 
            ],$messages);
        }

        //check the validator
        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Validation error occure in updating data') 
            ->withErrors($validator)->withInput();
        } 
        else
         { 
            try
            {
               $now = Carbon::now();
               DB::beginTransaction();
               $new_product = new Product();
               $product = array_merge($request->all(),['created_at' => $now, 'updated_at' => $now]);
               $product = array_splice($product,1, count($product)-1);
              
               
               if(array_key_exists('files', $product))
               {
                   unset($product['files']);
               }
               if(array_key_exists('image', $product))
               {
                   unset($product['image']);
               }

               foreach($product as $key=>$val)
               {
                   if(is_array($product[$key]))
                   {
                       $product[$key] = json_encode($product[$key]);
                   }
                   if($key == 'slug')
                   {
                    $product[$key] = str_replace(' ','_',$product[$key]);
                   }
               }

               

             
               $id = DB::table('products')->insertGetId($product);     
               
               DB::commit();
              
               return  redirect()->route('viewproduct')->with('success','New product added successfully');
               
               
            }   
            catch(Exception $e)
            {
                DB::rollBack();
                return redirect()->back()->with('error','Some thing wen wrong');
            }  

         }
    }
    //*****************Edit Fuction****************** */
     public function edit(Product $product)
     {
        //  dd($product);/
         $brands = Brand::all();
        $sizes = Size::all();
        $categories = Category::all();
        $sub_categories = Sub_Category::all()->KeyBy('id');

        return view('admin.product.edit',compact('product','brands','sizes','categories','sub_categories'));
     }

     public function update(Request $request)
     {

        if(isset($request->is_discount) && $request->is_discount =='1' && $request->is_discount != null)
        {
            $messages = [ 
                'title.required'=>'Please enter Product Title', 
                'subtitle.required'=>'Please enter Product Subtitle',                
                'short_description.required'=>'Please enter Product Short Description',
                'long_description.required'=>'Please enter Product Long Description',
                'actual_price.required'=>'Please enter Product Price',
                'is_discount.required'=>'Please select Discount option',
                'discount.required'=>'Please enter any value in discount',
                'discount_in.required'=>'Please select Discount in option',
                'status.required'=>'Please select Product Status', 
                'length.required'=>'Please select Product Length',
                'size_id.required'=>'Please select Product Size',
                'brand_id.required'=>'Please select Product Brand',
                'categories.required'=>'Please enter Product Category',
                'sub_categories.required'=>'Please enter Product Sub-Category', 
            ];
            
            $validator = Validator::make($request->all(),[ 
                'title' => 'required',
                'subtitle' => 'required', 
                'short_description'=>'required',
                'long_description'=>'required',
                'actual_price'=>'required',
                'is_discount'=>'required',
                'discount'=>'required|numeric',
                'discount_in'=>'required',
                'status' => 'required',           
                'length' => 'required',
                'size_id'=>'required',
                'brand_id'=>'required',
                'categories'=>'required',
                'sub_categories'=>'required', 
            ],$messages);
        }
        else
        {
            $messages = [ 
                'title.required'=>'Please enter Product Title', 
                'subtitle.required'=>'Please enter Product Subtitle', 
                'short_description.required'=>'Please enter Product Short Description',
                'long_description.required'=>'Please enter Product Long Description',
                'actual_price.required'=>'Please enter Product Price',
                'is_discount.required'=>'Please select Discount option',
                'status.required'=>'Please select Product Status', 
                'length.required'=>'Please select Product Length',
                'size_id.required'=>'Please select Product Size',
                'brand_id.required'=>'Please select Product Brand',
                'categories.required'=>'Please enter Product Category',
                'sub_categories.required'=>'Please enter Product Sub-Category', 
                
            ];
            
            $validator = Validator::make($request->all(),[ 
                'title' => 'required|unique:products',
                'subtitle' => 'required', 
                'short_description'=>'required',
                'long_description'=>'required',
                'actual_price'=>'required',
                'is_discount'=>'required',
                'status' => 'required',           
                'length' => 'required',
                'size_id'=>'required',
                'brand_id'=>'required',
                'categories'=>'required',
                'sub_categories'=>'required', 
                 
            ],$messages);
        }

        //check the validator
        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Validation error occure in updating data') 
            ->withErrors($validator)->withInput();
        } 
        else
         { 
            try
            {
               $now = Carbon::now();
               DB::beginTransaction();

               $product_for_update = Product::where('id',$request->id)->first();
                if($product_for_update != null)
                {
                    $product = new Product();
                    $product = array_merge($request->all(),['created_at' => $now, 'updated_at' => $now]);
                    $product = array_splice($product,1, count($product)-1);                
                    
                    if(array_key_exists('files', $product))
                    {
                        unset($product['files']);
                    }
                    if(array_key_exists('image', $product))
                    {
                        unset($product['image']);
                    }
                    //convert array values in json string
                    foreach($product as $key=>$val)
                    {
                        if(is_array($product[$key]))
                        {
                            $product[$key] = json_encode($product[$key]);
                        }
                        if($key == 'slug')
                        {
                        $product[$key] = str_replace(' ','_',$product[$key]);
                        }
                    } 
                    //update query
                    $product_for_update->update($product);     
                    
                    DB::commit();
                
                    return  redirect()->route('viewproduct')->with('success','Product updated successfully');
                }
                else{
                    return  redirect()->route('viewproduct')->with('error','Something went wrong');
                }
            }   
            catch(Exception $e)
            {
                DB::rollBack();
                return redirect()->back()->with('error','Some thing wen wrong');
            }  
         }
       
     }

     //*****************End Edit Fuction****************** */
  
    public function validateSlug(Request $request)
    {
        $request_data = $request->all();
        if (isset($request_data['product-id'])) {
            $obj_slug = Product::where('id', '!=', $request_data['product-id'])->where('slug', $request_data['slug'])->get();
        } else {
            $obj_slug = Product::where('slug', $request_data['slug'])->get();
        }

        if (count($obj_slug) > 0) {
            return response()->json(array('error' => "Slug already exists"), 400);
        } else {
            return response()->json(array('success'),200);
        }
    }
      //****************** all deleted product detail ***********************
    public function trash_index(Request $request)
    {
        if ($request->has('trashed')) {
            $products = Product::onlyTrashed()
                ->get();
        }
        else
        {
            $products = Product::get();
        }  

        return view('admin.product.trash', compact('products'));
    }
  

    /**
     * soft delete Product
     *
     * @return void
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
  
        return redirect()->back()->with('success','Product detail send to trash');
    }
  
    /**
     * restore specific Product
     *
     * @return void
     */
    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
  
        return redirect()->back();
    }  
  
    /**
     * restore all Product
     *
     * @return response()
     */
    public function restoreAll()
    {
        Product::onlyTrashed()->restore();
  
        return redirect()->back();
    }
    //*******************Image show,add and delete function*********************** */
    public function image(Product $product)
    {
            
            $product_id = $product->id;  
            $product_images = ProductImage::where('product_id', $product_id)->get();

            return view('admin.product.viewImage',compact('product','product_images'));

    }

    public function storeImage(Request $request)
    {
        
        $messages = [ 
            'image.required'=>'Please enter Product Title',             
        ];
        
        $validator = Validator::make($request->all(),[ 
            'image.*' => 'required|mimes:jpg,gif,png,jpeg,bmp',  
        ],$messages);

         //check the validator
         if ($validator->fails()) {

            return redirect()->back()->with('error', 'Validation error occure in updating data') 
            ->withErrors($validator)->withInput();
        } 
        else
         { 
            try
            {
               $now = Carbon::now();
               DB::beginTransaction();
               
                if(is_array($request->image) && count($request->image)>0)
                {
                    
                    $total_doc = count($request->image);
                    Log::info($total_doc);
                    for($i=0;$i<= $total_doc-1;$i++)
                    {
                        $name_gen=hexdec(uniqid()).'.'.$request->image[$i]->getClientOriginalExtension();
                        Image::make($request->image[$i])->resize(300,330)->save('upload/images/'.$name_gen);
                        $filename='upload/images/'.$name_gen;

                        //insert the document one by one

                        DB::table('product_images')->insert([
                            'product_id'=> $request->product_id,
                            'image_path'=>$filename,
                            'created_at'=> $now,
                            'updated_at'=> $now
                        ]);
                    }
                
                DB::commit();              
                return  redirect()->back()->with('success','Image added successfully');
               }
               else
               {
                DB::rollback();              
                return  redirect()->back()->with('error','Something went worng. Try again');
               } 
               
               
            }   
            catch(Exception $e)
            {
                DB::rollBack();
                return redirect()->back()->with('error','Some thing wen wrong');
            }  
        }
    }

    public function destroyImage(ProductImage $image)
    { 
        $filename =   public_path($image->image_path);
        
        
         if (File::exists($filename)) {
            Log::info("photo File exist");
            Log::info($filename);
            File::delete($filename);
        }
        $image->delete();

        return redirect()->back();
   
    }
}
