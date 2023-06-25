<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        
        $support = Admin::create([
            'name' => 'Support',
            'email' => 'support@support.com',
            'password' => bcrypt('support')
        ]);
        
        $adminRole = Role::create(['name' => 'admin']);
        $supportRole = Role::create(['name' => 'support']);
        
        $adminPermission = Permission::create(['name' => 'can-do-anything']);
        $supportPermission = Permission::create(['name' => 'only-view']);
        
        $adminRole->givePermissionTo($adminPermission);
        $adminPermission->assignRole($adminRole);
        
        $supportRole->givePermissionTo($supportPermission);
        $supportPermission->assignRole($supportRole);
    }
}
