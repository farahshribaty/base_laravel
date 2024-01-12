<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['super_admin', 'admin'];

        foreach ($roles as $role) {
            \App\Models\Role::create([
                'name' => $role,
            ]);
        }
    }
}
