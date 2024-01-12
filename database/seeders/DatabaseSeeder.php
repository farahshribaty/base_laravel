<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\CartItem;
use Faker\Factory as FakerFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();

        \App\Models\Product::factory(20)->create()->each(function ($product) {
            $product->productTranslations()->saveMany(\Database\Factories\ProductTranslationFactory::new()->count(3)->make());
        });

        \App\Models\Category::factory(10)->create()->each(function ($category) {
            $category->categoryTranslations()->saveMany(\Database\Factories\CategoryTranslationFactory::new()->count(3)->make());
        });

        Cart::factory(10)->create()->each(function ($cart) {
            $cart->cartItems()->saveMany(CartItem::factory(3)->make());
        });

        \App\Models\Wishlist::factory(30)->create();
        // \App\Models\Cart::factory(30)->create();
        // \App\Models\CartItem::factory(30)->create();
        
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);

    }
}
