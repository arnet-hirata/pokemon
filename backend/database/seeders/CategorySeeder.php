<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert(
            [
                ['name' => 'おもちゃ・ぬいぐるみ'],
                ['name' => 'ゲーム'],
                ['name' => 'ポケモンカードゲーム'],
                ['name' => '雑貨・小物'],
                ['name' => '文房具'],
                ['name' => 'スマホ・PC用品'],
                ['name' => '生活雑貨'],
                ['name' => 'アパレル・服'],
                ['name' => 'バック・ポーチ'],
                ['name' => 'お菓子・食品'],
            ]
        );
    }
}
