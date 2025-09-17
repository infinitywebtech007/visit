<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role= Role::create(['name'=>'admin']);
        $permission = Permission::create(['name' => 'manage-visits']);
        $role->givePermissionTo($permission);
        $permission= Permission::create(['name' => 'manage-employees']);
        $role->givePermissionTo($permission);

        $user=User::create([
            'name' => 'Admin',
            'email' => 'admin@visit.test',
            'password' => 'password',
        ]);
        $user->assignRole('admin');
    }
}
