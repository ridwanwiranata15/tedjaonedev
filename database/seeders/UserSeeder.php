<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // 1. Buat User
    $user = User::create([
        'name'     => 'Administrator',
        'email'    => 'admin@gmail.com',
        'phone'    => '085777750854',
        'photo'    => 'onedev.jpg',
        'password' => Hash::make('onedev123')
    ]);

    // 2. Gunakan firstOrCreate agar tidak null
    $role = Role::firstOrCreate(
        ['name' => 'admin', 'guard_name' => 'api']
    );

    // 3. Ambil semua permission untuk guard api
    $permissions = Permission::where('guard_name', 'api')->get();

    // 4. Sinkronisasi (Sekarang tidak akan error karena $role sudah pasti ada)
    $role->syncPermissions($permissions);

    // 5. Assign role ke user
    $user->assignRole($role);
    }
}
