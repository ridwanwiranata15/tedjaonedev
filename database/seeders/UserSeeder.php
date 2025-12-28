<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $user = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        // Ambil role admin untuk guard 'api'
        $role = Role::where('name', 'admin')->where('guard_name', 'api')->first();

        // Assign semua permission ke role ini
        $permissions = Permission::where('guard_name', 'api')->get();
        $role->syncPermissions($permissions);

        // Assign role ke user
        $user->assignRole($role);
    }
}
