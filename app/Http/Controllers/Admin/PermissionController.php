<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    private $themeLayout;
    
    public function __construct()
    {
        $this->themeLayout = app()['themeLayout'];
        
        $this->middleware('permission:Permission-create,admin')->only('store');
        $this->middleware('permission:Permission-list,admin')->only('index');
        $this->middleware('permission:Permission-show,admin')->only('show');
        $this->middleware('permission:Permission-update,admin')->only('update');
        $this->middleware('permission:Permission-delete,admin')->only('destroy');
    }
    
    private function getModels()
    {
        return Permission::WhereNotIn('name', ['super-admin'])->orderBy('updated_at', 'desc')->paginate(5);
    }
    public function index()
    {
        $models = $this->getModels();

        return view($this->themeLayout.'permissions.index', compact('models'));
    }
    
    public function store(StorePermissionRequest $request)
    {
        $validated = $request->validated();
        
        Permission::create($validated + ['guard_name' => 'admin']);
        
        return redirect()->back()->withSuccess('Data saved successfully.');
    }
    
    public function show(Permission $permission)
    {
        $models = $this->getModels();
        
        return view($this->themeLayout.'permissions.show', compact('models', 'permission'));
    }
    
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        
        $permission->update($validated);
        
        return redirect()->route('admin.permissions.index')->withSuccess('Data updated successfully.');
    }
    
    public function destroy(Permission $permission)
    {
        $permission->delete();
        
        return redirect()->route('admin.permissions.index')->withSuccess('Data deleted successfully.');
    }
}
