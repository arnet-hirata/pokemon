<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favorite;
use App\Models\Order_detail;
use App\Models\Order;
use App\Models\Stock;


use App\Models\Delivery;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

 

        
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
        ]);
        User::factory(200)->create();
        Delivery::factory(200)->create();
      
            $this->call([
            ProductSeeder::class,
            FavoriteSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            StockSeeder::class,
            ProductImageSeeder::class,
            CartItemSeeder::class,

        ]);
    }
}
