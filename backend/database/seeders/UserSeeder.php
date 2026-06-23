<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert(
            [
                ['name' => 'admin1',
                'email'=>'test@test.com',
                'email_verified_at' => now(),
                'tel'=>'08000001111',
                'postal'=>'8740811',
                'address'=>'本社',
                'password'=>Hash::make('password'),
                'role'=>5,
                ],
            ]
        );
    }
}
