<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $themeLayout;
    
    public function __construct()
    {
        $this->themeLayout = app()['themeLayout'];
    }
    
    private function getModels()
    {
        return Role::WhereNotIn('name', ['super-admin'])->orderBy('updated_at', 'desc')->paginate(5);
    }
    
    public function index()
    {
        $models = $this->getModels();
        $permissions = Permission::all();
        
        return view($this->themeLayout.'roles.index', compact('models','permissions'));
    }
    
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();
        
        $role = [
            'guard_name' => 'admin',
            'name' => $validated['name'],
        ];
        
        Role::create($role)->syncPermissions($validated['permissions']);
        
        return redirect()->back()->withSuccess('Data saved successfully.');
    }
    
    public function show(Role $role)
    {
        $models = $this->getModels();
     
        $permissions = Permission::all();
        foreach ($role->permissions as $permission) {
            $selectedPermission[] = $permission->name;
        }
        
        return view($this->themeLayout.'roles.show', compact('role', 'permissions', 'selectedPermission', 'models'));
    }
    
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $role->update($validated);
        $role->syncPermissions($validated['permissions']);
        
        return redirect()->route('admin.roles.index')->withSuccess('Data updated successfully.');
    }
    
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->withSuccess('Data deleted successfully.');
    }
}
