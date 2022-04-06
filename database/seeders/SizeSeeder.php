<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // `size_no`, `size_shortcut`, `prifix`, `waist_size`, `hip_size`, `chest_size`, `created_at`, `updated_at`
        Size::create([
            'size_no'=>6,
            "size_shortcut"=>"XS",            
            "prifix"=>"UK",
            "chest_size"=>81,
            "waist_size"=>63,
            "hip_size"=>86,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Size::create([
            'size_no'=>8,
            "size_shortcut"=>"S",            
            "prifix"=>"UK",
            "chest_size"=>83,
            "waist_size"=>65,
            "hip_size"=>89,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Size::create([
            'size_no'=>10,
            "size_shortcut"=>"M",            
            "prifix"=>"UK",
            "chest_size"=>88,
            "waist_size"=>70,
            "hip_size"=>94,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Size::create([
            'size_no'=>12,
            "size_shortcut"=>"L",            
            "prifix"=>"UK",
            "chest_size"=>93,
            "waist_size"=>75,
            "hip_size"=>99,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Size::create([
            'size_no'=>14,
            "size_shortcut"=>"XL",            
            "prifix"=>"UK",
            "chest_size"=>98,
            "waist_size"=>80,
            "hip_size"=>104,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Size::create([
            'size_no'=>16,
            "size_shortcut"=>"XXL",            
            "prifix"=>"UK",
            "chest_size"=>105,
            "waist_size"=>86,
            "hip_size"=>111,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        Size::create([
            'size_no'=>18,
            "size_shortcut"=>"XXL",            
            "prifix"=>"UK",
            "chest_size"=>111,
            "waist_size"=>92,
            "hip_size"=>117,           
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
    }
}
