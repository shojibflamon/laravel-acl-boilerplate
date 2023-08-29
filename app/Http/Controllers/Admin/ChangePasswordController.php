<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangePasswordRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ChangePasswordController extends Controller
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
        return view($this->themeLayout.'profile.change-password', compact('model'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  ChangePasswordRequest  $request
     * @return RedirectResponse
     */
    public function update(ChangePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        auth('admin')->user()->update([
            'password' => bcrypt($validated['password']),
        ]);
        
        return redirect()->back()->withSuccess('Data updated successfully.');
    }
}
