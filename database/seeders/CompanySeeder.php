<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            "name"=>"shineweb Technology",
            "email"=>"shineweb@gmail.com",
            "password"=>bcrypt('12345678'),
            "timezone"=>"asia",
            "loginip"=>"2767873",
             "token"=>bcrypt('12345678'),

        ]);

    }
}
