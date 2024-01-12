<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdminRole>
 */
class AdminRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AdminRole::class;

    public function definition()
    {
        return [
            'admin_id' => Admin::factory(),
            'role_id' => Role::factory(),
        ];
    }
}
