<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //`title`, `sub_title`, `image_path`, `hyperlink`, `status`, `created_at`, `updated_at`
        Slider::create([
            'title'=>"New trandy style outfit",
            "sub_title"=>"Choose new look ",            
            "image_path"=>"customer_template/images/slide-04.jpg",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Slider::create([
            'title'=>"New trandy style outfit",
            "sub_title"=>"Choose new look ",            
            "image_path"=>"customer_template/images/slide-03.jpg",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Slider::create([
            'title'=>"New trandy style outfit",
            "sub_title"=>"Choose new look ",            
            "image_path"=>"customer_template/images/slide-02.jpg",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Slider::create([
            'title'=>"New trandy style outfit",
            "sub_title"=>"Choose new look ",            
            "image_path"=>"customer_template/images/slide-01.jpg",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
    }
}
