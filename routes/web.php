<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

/*Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {
    
    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');
    
    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
    
});*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        /*
         * ----------------------------------------------------------------
         * LOGIN ROUTES
         * ----------------------------------------------------------------
         * */
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('login.submit');
    });
    
    Route::middleware('admin')->group(function () {
        /*
        * ----------------------------------------------------------------
        * DASHBOARD ROUTES
        * ----------------------------------------------------------------
        * */
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        
        Route::get('profile', 'ProfileController@show')->name('profile.show');
        Route::put('profile', 'ProfileController@update')->name('profile.update');
        
        Route::get('change-password', 'ChangePasswordController@show')->name('changePassword.show');
        Route::put('change-password', 'ChangePasswordController@update')->name('changePassword.update');
        
        Route::get('default', 'HomeController@default')->name('default');
        Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
        
        /*
        * ----------------------------------------------------------------
        * ROLE & PERMISSION ROUTES
        * ----------------------------------------------------------------
        * */
        Route::resource('roles', "RoleController");
        Route::resource('permissions', "PermissionController");
        
        /*
        * ----------------------------------------------------------------
        * USERS ROUTES
        * ----------------------------------------------------------------
        * */
        Route::resource('admins', "AdminController");
    });
    
});