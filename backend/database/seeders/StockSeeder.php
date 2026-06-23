<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('stocks')->insert([
            [
                'product_id' => 1,
                'change_stock' => 5,
                'reason' => '減った',
                'created_at' => now(),
            ],
            [
                'product_id' => 2,
                'change_stock' => 3,
                'reason' => '増えた',
                'created_at' => now(),
            ],
            [
                'product_id' => 3,
                'change_stock' => 3,
                'reason' => '減った',
                'created_at' => now(),
            ],
        ]);
    }
}
