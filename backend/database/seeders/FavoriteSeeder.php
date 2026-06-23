<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('favorites')->insert([
            [
                'user_id' => 1,
                'product_id' => 1,
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'created_at' => now(),
            ],
            [
                'user_id' => 3,
                'product_id' => 3,
                'created_at' => now(),
            ],
        ]);

    }
}
