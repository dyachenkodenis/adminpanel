<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database user seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Denis Dyachenko',
            'role' => 'admin',
            'email' => 'd.dyachenko@alex-its.uz',
            'password' => Hash::make('12345678'),
        ]);
    }
}
