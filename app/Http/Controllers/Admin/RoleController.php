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
        
        $this->middleware('permission:Role-create,admin')->only('store');
        $this->middleware('permission:Role-list,admin')->only('index');
        $this->middleware('permission:Role-show,admin')->only('show');
        $this->middleware('permission:Role-update,admin')->only('update');
        $this->middleware('permission:Role-delete,admin')->only('destroy');
    }
    
    private function getModels()
    {
//        return Role::WhereNotIn('name', ['Super-Admin'])->orderBy('updated_at', 'desc')->paginate(5);
        return Role::orderBy('updated_at', 'desc')->paginate(5);
    }
    
    public function index()
    {
        $models = $this->getModels();
        
        $permissionGroups = [];
        foreach (Permission::all() as $permission) {
            $group = explode('-', $permission->name)[0];
            $permissionGroups[$group][] = $permission->name;
        }
        
        return view($this->themeLayout.'roles.index', compact('models', 'permissionGroups'));
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
        
        $permissionGroups = [];
        foreach (Permission::all() as $permission) {
            $group = explode('-', $permission->name)[0];
            $permissionGroups[$group][] = $permission->name;
        }
        
        $selectedPermission = $role->permissions->pluck('name')->all();
        
        return view($this->themeLayout.'roles.show', compact('role', 'models', 'permissionGroups', 'selectedPermission'));
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
