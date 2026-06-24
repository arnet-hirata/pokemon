<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記


class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
                        DB::table('order_details')->insert([
            [
                'product_id' => 1,
                'order_id' => 1,
                'quantity' => 1,
                'product_price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'order_id' => 2,
                'quantity' => 1,
                'product_price' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'order_id' => 3,
                'quantity' => 1,
                'product_price' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);



    }
}
