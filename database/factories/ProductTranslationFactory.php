<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductTranslation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductTranslation>
 */
class ProductTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductTranslation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'locale' => $this->faker->randomElement([1,2]),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
