<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => '商品A',
                'price' => 100,
                'category_id' => 1,
                'release_date' => now(),
                'text' => '本日発売',
                'stock' => '500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '商品B',
                'price' => 300,
                'category_id' => 2,
                'release_date' => now(),
                'text' => '残りわずか',
                'stock' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '商品C',
                'price' => 500,
                'category_id' => 3,
                'release_date' => now(),
                'text' => '人気商品',
                'stock' => '200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
