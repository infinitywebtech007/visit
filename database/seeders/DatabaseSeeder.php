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
        
        $permission = Permission::create(['name' => 'manage-roles-and-permissions']);
        $role->givePermissionTo($permission);
        
        $permission = Permission::create(['name' => 'visits-create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'visits-edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'visits-delete']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'visits-view']);
        $role->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'employees-create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'employees-edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'employees-delete']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'employees-view']);
        $role->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'visitors-create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'visitors-edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'visitors-delete']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'visitors-view']);
        $role->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'users-create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'users-edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'users-delete']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'users-view']);
        $role->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'reports-create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'reports-edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'reports-delete']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'reports-view']);
        $role->givePermissionTo($permission);
        

        $permission = Permission::create(['name' => 'settings-create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'settings-edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'settings-delete']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'settings-view']);
        $role->givePermissionTo($permission);
        
    }
}
