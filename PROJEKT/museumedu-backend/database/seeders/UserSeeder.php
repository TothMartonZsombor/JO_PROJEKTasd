<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Marci',
                'password' => 'Marci1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ádám',
                'password' => 'Adam1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
