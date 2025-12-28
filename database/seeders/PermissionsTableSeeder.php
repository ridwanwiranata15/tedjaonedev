<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'cities.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'cities.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'cities.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'cities.delete', 'guard_name' => 'api']);
    }
}
