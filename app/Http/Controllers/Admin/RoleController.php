<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $models = Role::WhereNotIn('name',['admin'])->paginate(5);
        
        $themeLayout = App::make('themeLayout');
        
        return view($themeLayout.'roles.index', compact('models'));
    }
    
    public function store(StoreRoleRequest $request)
    {
        // Retrieve validated data from the request
        $data = $request->validated();
        
        $data['guard_name'] = 'admin';
       
        Role::create($data);
        Log::info(json_encode($data));
      
        // Redirect to a success page or perform other actions
        return redirect()->route('admin.roles.index')->with('success', 'Data saved successfully.');
    }
}
