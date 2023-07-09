<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $models = Permission::paginate(5);

        $themeLayout = App::make('themeLayout');
        
        return view($themeLayout.'permissions.index', compact('models'));
    }
    
    public function store(StorePermissionRequest $request)
    {
        // Retrieve validated data from the request
        $data = $request->validated();
        
        $data['guard_name'] = 'admin';
        
        Permission::create($data);
        
        // Redirect to a success page or perform other actions
        return redirect()->route('admin.permissions.index')->with('success', 'Data saved successfully.');
    }
}
