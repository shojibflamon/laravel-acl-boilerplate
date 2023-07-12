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
        
        $supportRole = Role::create(['guard_name' => 'admin', 'name' => 'support']);
        $adminRole = Role::create(['guard_name' => 'admin', 'name' => 'Super Admin']);
        
        $adminPermission = Permission::create(['guard_name' => 'admin', 'name' => 'can-do-anything']);
        $supportPermission = Permission::create(['guard_name' => 'admin', 'name' => 'only-view']);
        
        $supportRole->givePermissionTo($supportPermission);
        $adminRole->givePermissionTo($adminPermission);
        
        $admin->assignRole($adminRole);
        $support->assignRole($supportRole);
    }
}
