<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

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
            "password"=>bcrypt("12345678"),
        ]);

        User::create([
            'name'=>"customer",
            "lname"=>"customer",
            "dob"=>Carbon::parse("01-01-1990"),
            "role_id"=>1,
            "status"=>1,
            "is_newsletter"=>0,
            "email"=>"customer@gmail.com",
            "password"=>bcrypt("12345678"),
        ]);
    }
}
