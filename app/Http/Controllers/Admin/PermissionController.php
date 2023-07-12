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
        
        $validated['guard_name'] = 'admin';
        
        Permission::create($validated);
        
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
