<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [''];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
