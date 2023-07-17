<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Jobs\AtsEmailJob;
use App\Models\User;
use App\Notifications\ThankYouEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
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
        dump(config('mail.mailers.smtp'));
        Permission::create(['name'=>Str::random(4)] + ['guard_name' => 'admin']);
        $models = $this->getModels();
        
        $user = Auth::guard('admin')->user();
        
        
        // Step 1: Notifiable trait
        $user->notify(new ThankYouEmailNotification($user));
        
        // Step 2: Notification Facade
        // use Illuminate\Support\Facades\Notification;
//        Notification::send($user, new ThankYouEmailNotification($user));
        
        // Step 3: Event
//        dispatch(new AtsEmailJob($user));
        
        // Step 4: Observer
        
        dd('End');
        
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
