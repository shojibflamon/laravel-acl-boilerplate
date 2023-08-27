<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Collection;

class PermissionService
{
    /**
     * @param  Collection  $collection
     * @return array
     */
    public function getPermissionGroups(Collection $collection): array
    {
        $permissionGroups = [];
        
        foreach ($collection as $permission) {
            $group = explode('-', $permission->name)[0];
            $permissionGroups[$group][] = $permission->name;
        }
        
        /*
         * Same as above
         * Laravel collection way
         * */
        
        /*
        $permissionGroups = $collection->groupBy(function ($permission) {
            return explode('-', $permission->name)[0];
        })
            ->map(function ($permissions) {
                return $permissions->pluck('name');
            })
            ->toArray();
        */
        
        return $permissionGroups;
    }
    
    /**
     * @param  Admin  $admin
     * @param  array  $validated
     * @return void
     */
    public function syncPermissions(Admin $admin, array $validated): void
    {
        if (!isset($validated['permissions'])) {
            $validated['permissions'] = [];
        }
        $admin->syncPermissions($validated['permissions']);
    }
    
    /**
     * @param  Admin  $admin
     * @param  array  $validated
     * @return void
     */
    public function syncRoles(Admin $admin, array $validated): void
    {
        if (!isset($validated['roles'])) {
            $validated['roles'] = [];
        }
        $admin->syncRoles($validated['roles']);
    }
}