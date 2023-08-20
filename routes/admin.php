<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UpdateController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class ,'showLogin']);
Route::post('/login', [LoginController::class ,'login']);
Route::get('/login/check', function (){
    return auth()->check() ? true :  view('admin.auth.modal.login');
});
Route::get('/logout', [LoginController::class ,'logout']);

Route::get('/', [DashboardController::class, 'index']);
Route::get('/makeadmin', [RoleController::class, 'makeAdminDefaultPermission']);

Route::prefix('permissions')->group(function(){
    Route::get('/', [PermissionController::class, 'index']);
    Route::get('create', [PermissionController::class, 'create']);
    Route::post('store', [PermissionController::class, 'store']);
    Route::get('edit/{id}', [PermissionController::class, 'edit']);
    Route::post('update', [PermissionController::class, 'update']);
    Route::post('delete', [PermissionController::class, 'delete']);
});

Route::prefix('roles')->group(function(){
    Route::get('/', [RoleController::class, 'index']);
    Route::get('create', [RoleController::class, 'create']);
    Route::post('store', [RoleController::class, 'store']);
    Route::get('/{id}/edit', [RoleController::class, 'edit']);
    Route::post('/{id}/update', [RoleController::class, 'update']);
    Route::get('/{id}/delete', [RoleController::class, 'delete']);
});

Route::prefix('users')->group(function(){
    Route::get('/', [UserController::class, 'index']);
    Route::get('create', [UserController::class, 'create']);
    Route::post('store', [UserController::class, 'store']);
    Route::get('view/{id}/{view?}', [UserController::class, 'view']);
    Route::get('edit/{id}/{edit}', [UserController::class, 'edit']);
    Route::post('update', [UserController::class, 'update']);
    Route::get('action/{id}/{action}', [UserController::class, 'action']);

    Route::get('profile/{view?}', [UserController::class, 'view']);
    Route::get('/{user_id}/impersonate', [UserController::class, 'impersonate']);
});

Route::prefix('settings')->group(function(){
    Route::get('/', function(){
        return view('admin.settings.index');
    });

    Route::group(['prefix' => 'general'], function () {
        Route::get('/', [UpdateController::class, 'index']);
    });

    Route::group(['prefix' => 'update-app'], function () {
        Route::get('/', [UpdateController::class, 'index']);
        Route::post('/basic', [UpdateController::class, 'basicUpdate']);
        Route::post('/custom-update', [UpdateController::class, 'customUpdate']);
        Route::post('/database', [UpdateController::class, 'databaseUpdate']);
    });
});
