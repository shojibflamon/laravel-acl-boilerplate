<?php

use App\Http\Controllers\Admin\PermissionController;
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
        Route::get('default', 'HomeController@default')->name('default');
        Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
        
        /*
        * ----------------------------------------------------------------
        * PERMISSION ROUTES
        * ----------------------------------------------------------------
        * */
        Route::resource('roles', "RoleController");
        Route::resource('permissions', "PermissionController");
    });
    
});