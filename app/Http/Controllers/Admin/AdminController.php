<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\PermissionService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    private $themeLayout;
    
    public function __construct()
    {
        $this->middleware('permission:Admin-create,admin')->only(['create', 'store']);
        $this->middleware('permission:Admin-list,admin')->only('index');
        $this->middleware('permission:Admin-show,admin')->only('show');
        $this->middleware('permission:Admin-update,admin')->only('update');
        $this->middleware('permission:Admin-delete,admin')->only('destroy');
        
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
        $roles = Role::pluck('name');
        
        return view($this->themeLayout.'admins.create', compact('roles'));
    }
    
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();
        
        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        
        if (!isset($validated['roles'])) {
            $validated['roles'] = [];
        }
        
        $admin->syncRoles($validated['roles']);
        
        return redirect()->back()->withSuccess('Data saved successfully.');
    }
    
    public function show(Admin $admin, PermissionService $permissionService)
    {
        $models = $this->getModels();
        
        $roles = Role::pluck('name');
        
        $selectedRoles = $admin->getRoleNames()->all();
        
        $permissionGroups = $permissionService->getPermissionGroups(Permission::all());
        
        $selectedPermission = $admin->getAllPermissions()->pluck('name')->all();
        
        return view($this->themeLayout.'admins.show', compact('admin', 'models', 'roles', 'selectedRoles', 'permissionGroups', 'selectedPermission'));
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
        $admin->delete();
        
        return redirect()->route('admin.admins.index')->withSuccess('Data deleted successfully.');
    }
}
