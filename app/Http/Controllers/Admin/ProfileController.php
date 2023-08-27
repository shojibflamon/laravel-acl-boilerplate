<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    private $themeLayout;
    
    public function __construct()
    {
        $this->themeLayout = app()['themeLayout'];
    }
    
    /**
     * Display the specified resource.
     *
     * @return Application|Factory|View
     */
    public function show()
    {
        $model = auth('admin')->user();
        return view($this->themeLayout.'profile.show', compact('model'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProfileRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        auth('admin')->user()->update($validated);
        
        return redirect()->back()->withSuccess('Data updated successfully.');
    }
}
