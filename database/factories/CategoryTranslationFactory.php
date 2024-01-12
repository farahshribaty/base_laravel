<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoryTranslation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryTranslation>
 */
class CategoryTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CategoryTranslation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'locale' => $this->faker->randomElement([1, 2]),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
