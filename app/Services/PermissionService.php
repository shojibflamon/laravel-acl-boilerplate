<?php

namespace App\Services;

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
}