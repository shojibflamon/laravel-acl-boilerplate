<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    private $themeLayout;
    
    public function __construct()
    {
        $this->themeLayout = app()['themeLayout'];
    }
    
    private function getModels()
    {
        return Admin::paginate(5);
    }
    
    public function index()
    {
        $models = $this->getModels();
        
        return view($this->themeLayout.'admins.index', compact('models'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreAdminRequest $request)
    {
    }
    
    public function show(Admin $admin)
    {
        $models = $this->getModels();
        
        $roles = Role::pluck('name');
        
        $selectedRoles = $admin->getRoleNames()->all();
        
        $permissionGroups = Permission::all()
            ->groupBy(function ($permission) {
                return explode('-', $permission->name)[0];
            })
            ->map(function ($permissions) {
                return $permissions->pluck('name');
            })
            ->toArray();
        
        /*
         * Same as above
         * */
        /*$permissions = Permission::all();
        $permissionGroups = [];
        foreach ($permissions as $permission) {
            $group = explode('-', $permission->name)[0];
            $permissionGroups[$group][] = $permission->name;
        }*/
        
        $selectedPermission = $admin->getAllPermissions()->pluck('name')->all();
        
        return view($this->themeLayout.'admins.show', compact('models', 'admin', 'roles', 'selectedRoles', 'permissionGroups', 'selectedPermission'));
    }
    
    public function edit(Admin $admin)
    {
        //
    }
    
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $validated = $request->validated();
        
        $admin->update($validated);
        
        if (!isset($validated['permissions'])) {
            $validated['permissions'] = [];
        }
        $admin->syncPermissions($validated['permissions']);
        
        if (!isset($validated['roles'])) {
            $validated['roles'] = [];
        }
        
        $admin->syncRoles($validated['roles']);
        
        return redirect()->route('admin.admins.index')->withSuccess('Data updated successfully.');
    }
    
    public function destroy(Admin $admin)
    {
        //
    }
}