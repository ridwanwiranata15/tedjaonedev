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
        Permission::create(['name' => 'banks.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'banks.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'banks.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'banks.delete', 'guard_name' => 'api']);
        Permission::create(['name' => 'categories.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'categories.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'categories.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'categories.delete', 'guard_name' => 'api']);
        Permission::create(['name' => 'facilities.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'facilities.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'facilities.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'facilities.delete', 'guard_name' => 'api']);
    }
}
