<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DiceroSeeder extends Seeder
{

    public function run()
    {
        DB::table("role")->insert([
            "id_role" => 1,
            "nama_role" => "super"
        ]);
        DB::table("user")->insert([
            "username" => "superadmin",
            "password" => Hash::make("12345678"),
            "email" => "superadmin@test.com",
            "id_role" => 1
        ]);
    }
}
