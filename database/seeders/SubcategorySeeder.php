<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sub_Category;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //`category_id`, `name`, `description`, `seo_title`, `seo_keyword`, `seo_description`, `created_at`, `updated_at` 
         Sub_Category::create([
            'id'=>1,
            'category_id'=>1,
            'name'=>"Curve",         
            "description"=>"Test Description",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Sub_Category::create([
            'id'=>2,
            'category_id'=>2,
            'name'=>"Black Tie",         
            "description"=>"Test Description",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
    }
}
