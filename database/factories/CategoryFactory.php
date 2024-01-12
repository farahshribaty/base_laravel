<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    public function definition()
    {
        return [
            'category_image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean,
            'parent_id' => null,
            'level' => $this->faker->randomNumber(1),
        ];
    }
}
