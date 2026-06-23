<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記
class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cart_items')->insert([
            [
                'product_id' => 1,
                'user_id' => 1,
                'quantity' => '100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'user_id' => 2,
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'user_id' => 3,
                'quantity' => '50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
