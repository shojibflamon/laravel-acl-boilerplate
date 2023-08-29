<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        /*
         * ----------------------------------------------------------------
         * LOGIN ROUTES
         * ----------------------------------------------------------------
         * */
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');
    });
    
    Route::middleware('admin')->group(function () {
        /*
        * ----------------------------------------------------------------
        * DASHBOARD ROUTES
        * ----------------------------------------------------------------
        * */
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        
        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'show')->name('profile.show');
            Route::put('profile', 'update')->name('profile.update');
        });
        
        Route::controller(ChangePasswordController::class)->group(function () {
            Route::get('change-password', 'show')->name('changePassword.show');
            Route::put('change-password', 'update')->name('changePassword.update');
        });
//        Route::get('change-password', 'ChangePasswordController@show')->name('changePassword.show');
//        Route::put('change-password', 'ChangePasswordController@update')->name('changePassword.update');
        
        Route::get('default', [HomeController::class, 'default'])->name('default');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        
        /*
        * ----------------------------------------------------------------
        * ROLE & PERMISSION ROUTES
        * ----------------------------------------------------------------
        * */
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        
        /*
        * ----------------------------------------------------------------
        * USERS ROUTES
        * ----------------------------------------------------------------
        * */
        Route::resource('admins', AdminController::class);
    });
});