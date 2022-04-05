<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
 
use App\Models\Brand;
use App\Models\Category;
use App\Models\Sub_Category;
use App\Models\Size;
use Image;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth; 
use Validator;

class Product extends Component
{
    public $currentstep =1;
    public $totalstep =3;
    //first strp variable
    public $title;
    public $subtitle;
    public $slug;
    public $short_description;
    public $long_description;
    public $actual_price;
    public $is_discount;
    public $discount;
    public $discount_in;
    //second step variable
    public $status;
    public $is_newarrival;
    public $brand_id;
    public $size_id;
    public $length;
    public $model_detail;
    public $categories_id;
    public $sub_categories_id; 

    //mount variable
    public $brands;
    public $sizes;
    public $categories;
    public $sub_categories; 


    public function mount()
    {
        $this->currentStep = 1;
        $this->totalstep = 3;
        //respective table data
        $this->brands = Brand::all();
        $this->sizes = Size::all();
        $this->categories = Category::all();
        $this->sub_categories = Sub_Category::all()->KeyBy('id');
    }
    public function render()
    {
        return view('livewire.admin.product');
    }
    public function previous()
    {
        if($this->currentstep >1)
        {
            $this->currentstep--;
        }
        
    }

    public function first_step()
    { 
         
        if(isset($this->is_discount) && $this->is_discount =='1' && $this->is_discount != null)
        {
            $validateData = $this->validate([ 
                'title' => 'required|unique:products',
                'subtitle' => 'required',
                'slug' => 'required|unique:products',
                'short_description'=>'required',
                'long_description'=>'required',
                'actual_price'=>'required',
                'is_discount'=>'required',
                'discount'=>'required|numeric',
                'discount_in'=>'required'
            ]);
        }
        else
        {
            $validateData = $this->validate([ 
                'title' => 'required|unique:products',
                'subtitle' => 'required',
                'slug' => 'required|unique:products',
                'short_description'=>'required',
                'long_description'=>'required',
                'actual_price'=>'required',
                'is_discount'=>'required'
                
            ]);
        }
        $this->fill($validateData);
        $this->currentstep++;
         
    }
    public function second_step()
    {
        $this->validate([ 
            'status' => 'required',
            'categories' => 'required',
            'sub_categories' => 'required',
            'length'=>'required',
            'size_id'=>'required',
            'brand_id'=>'required',
            
        ]);
        $this->currentstep++;
    }
    public function third_step()
    {
        $this->validate([ 
            'image' => 'required', 
            
        ]);
        $this->currentstep++;
    }

    public function add_product()
    {
          
    }
}
