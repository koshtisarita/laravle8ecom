<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>"admin",
            "lname"=>"admin",
            "dob"=>Carbon::parse("01-01-1990"),
            "role_id"=>0,
            "status"=>1,
            "is_newsletter"=>0,
            "email"=>"admin@gmail.com",
            "password"=>Hash::make("12345678"),
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);

        User::create([
            'name'=>"customer",
            "lname"=>"customer",
            "dob"=>Carbon::parse("01-01-1990"),
            "role_id"=>1,
            "status"=>1,
            "is_newsletter"=>0,
            "email"=>"customer@gmail.com",
            "password"=>Hash::make("12345678"),
            "created_at"=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
    }
}
