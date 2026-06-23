<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
                DB::table('orders')->insert([
            [
                'user_id' => 2,
                'pay_method' => 'クレジットカード',
                'total_price' => 5000,
                'order_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'pay_method' => 'クレジットカード',
                'total_price' => 2000,
                'order_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'pay_method' => 'クレジットカード',
                'total_price' => 500,
                'order_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


    }
}
