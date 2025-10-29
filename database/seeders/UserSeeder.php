<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert(
            // array(
            //     'name' => 'Admin',
            //     'email' => 'admin@gmail.com',
            //     'username' => 'admin',
            //     'password' => Hash::make('12345'), // fungsi hash untuk biar ga keliatan password nya, ngasamarin pw ny
            //     'role' => 1

            // ),
            array(
                'name' => 'User',
                'email' => 'user@gmail.com',
                'username' => 'User',
                'password' => Hash::make('12345') // fungsi hash untuk biar ga keliatan password nya, ngesamarin pw ny

            ),
        );
    }
}
