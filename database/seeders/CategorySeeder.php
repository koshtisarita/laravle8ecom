<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // `name`, `image_path`, `link`, `deleted_at`, `created_at`, `updated_at`
        Category::create([
            'id'=>1,
            'name'=>"Outfits",         
            "image_path"=>"customer_template/images/banner-04.jpg",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Category::create([
            'id'=>2,
            'name'=>"Occasions",         
            "image_path"=>"customer_template/images/blog-03.jpg",                 
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
    }
}
