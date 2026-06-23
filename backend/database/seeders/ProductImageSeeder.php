<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記
class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_images')->insert([
            [
                'image_name' => '商品A',
                'product_id' => 1,
                'path' => 'product123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '商品B',
                'product_id' => 2,
                'path' => 'product234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '商品C',
                'product_id' => 3,
                'path' => 'product345',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
