<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wishlist;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Wishlist::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
