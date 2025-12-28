<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin'
        ]);
        $leaderRole = Role::create([
            'name' => 'leader'
        ]);
        $agentRole = Role::create([
            'name' => 'agent'
        ]);
        $customerRole = Role::create([
            'name' => 'customer'
        ]);
        $user = User::create([
            'name'  => 'Team OneDev',
            'email' => 'team@onedev.com',
            'phone' => '085777750854',
            'photo' => 'onedev.jpg',
            'password' => Hash::make('onedev123')
        ]);

        $user->assignRole($adminRole);
    }
}
