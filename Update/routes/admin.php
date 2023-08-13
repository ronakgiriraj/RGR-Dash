<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\SubscriberPaymentsController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\LedgerController;
use App\Http\Controllers\Admin\NodeController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SubscriberPlanController;
use App\Http\Controllers\Admin\IspController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\UpdateController;
use App\Http\Controllers\Admin\InventoryController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class ,'showLogin']);
Route::post('/login', [LoginController::class ,'login']);
Route::get('/login/check', function (){
    return auth()->guard('web')->check() ? true :  view('admin.auth.modal.login');
});
Route::get('/logout', [LoginController::class ,'logout']);

Route::get('/', [DashboardController::class ,'index']);
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
    Route::get('view/{userId}/{step}', [UserController::class, 'view']);
    Route::get('edit/{userId}/{step}', [UserController::class, 'edit']);
    Route::post('update', [UserController::class, 'update']);
    Route::get('action/{action}/{userId}', [UserController::class, 'action']);
    Route::post('action/{action}', [UserController::class, 'actionByPost']);

    Route::get('profile/{user_id}/{view?}', [UserController::class, 'view']);
    Route::get('/{user_id}/impersonate', [UserController::class, 'impersonate']);
});

Route::prefix('attendance')->group(function(){
    Route::get('/{date?}', [AttendanceController::class, 'index']);
    Route::post('/{date}', [AttendanceController::class, 'index']);
    Route::get('store/{date}/{user_id}/{attendance}', [AttendanceController::class, 'store']);
    Route::post('remark/store/', [AttendanceController::class, 'storeRemark']);
});

Route::prefix('calendar')->group(function(){
    Route::get('/{date?}', [CalendarController::class, 'index']);
    Route::post('/{date}', [CalendarController::class, 'index']);
    Route::get('store/{date}/{user_id}/{attendance}', [CalendarController::class, 'store']);
});

Route::prefix('finance')->group(function(){
    Route::prefix('expenses')->group(function(){
        Route::get('/', [ExpenseController::class, 'index']);
        Route::post('store', [ExpenseController::class, 'store']);
    });

    Route::prefix('ledger')->group(function(){
        Route::get('/', [LedgerController::class, 'index']);
        Route::post('store', [LedgerController::class, 'store']);
        Route::post('update', [LedgerController::class, 'update']);
    });

    Route::prefix('subscriber')->group(function(){
        Route::prefix('payments')->group(function(){
            Route::get('/', [SubscriberPaymentsController::class, 'index']);
            Route::post('store', [SubscriberPaymentsController::class, 'store']);
        });
    });
});

Route::prefix('nodes')->group(function(){
    Route::get('/', [NodeController::class, 'index']);
    Route::get('create', [NodeController::class, 'create']);
    Route::post('store', [NodeController::class, 'store']);
});

Route::prefix('todo')->group(function(){
    Route::get('/', [TodoController::class, 'index']);
    Route::get('create', [TodoController::class, 'create']);
    Route::post('store', [TodoController::class, 'store']);
    Route::post('update', [TodoController::class, 'update']);
});

Route::prefix('tickets')->group(function(){
    Route::get('/', [TicketController::class, 'index']);
    Route::get('create', [TicketController::class, 'create']);
    Route::post('store', [TicketController::class, 'store']);
    Route::post('update', [TicketController::class, 'update']);

    Route::prefix('open')->group( function () {
        Route::get('/{id}', [TicketController::class, 'open']);
        Route::post('/{id}/comment', [TicketController::class, 'commentStore']);
        Route::post('/{id}/add-note', [TicketController::class, 'noteStore']);
        Route::get('/{id}/action/{type}/{value?}', [TicketController::class, 'action']);
    });
});

Route::prefix('leads')->group(function(){
    Route::get('/', [LeadController::class, 'index']);
    Route::get('create', [LeadController::class, 'create']);
    Route::post('store', [LeadController::class, 'store']);
    Route::get('online', [LeadController::class, 'online']);
    Route::get('request', [LeadController::class, 'onlineRequest']);
    Route::get('view/{customerId}/{step}', [LeadController::class, 'view']);
    Route::get('edit/{customerId}/{step}', [LeadController::class, 'edit']);
    Route::post('update', [LeadController::class, 'update']);
    Route::get('action/{action}/{customerId}', [LeadController::class, 'action']);
});

Route::prefix('subscribers')->group(function(){
    Route::get('/', [SubscriberController::class, 'index']);
    Route::get('/{type}/export', [SubscriberController::class, 'export']);
    Route::get('/filter', [SubscriberController::class, 'filter']);
    Route::get('create', [SubscriberController::class, 'create']);
    Route::post('store', [SubscriberController::class, 'store']);
    Route::get('view/{subscriberId}/{view?}', [SubscriberController::class, 'view']);
    Route::get('edit/{subscriberId}/{step}', [SubscriberController::class, 'edit']);
    Route::post('update', [SubscriberController::class, 'update']);
    Route::get('action/{subscriberId}/{action}', [SubscriberController::class, 'action']);
    Route::post('action/{subscriberId}/{action}', [SubscriberController::class, 'action']);
    Route::get('/state/{id}/district-list', [SubscriberController::class, 'districtList']);
    Route::get('/district/{id}/panchayat-list', [SubscriberController::class, 'panchayatList']);
    Route::get('/panchayat/{panchayat}/village-list', [SubscriberController::class, 'villageList']);
});

Route::prefix('plans')->group(function () {
    Route::get('/', [SubscriberPlanController::class, 'index']);
    Route::get('/create', [SubscriberPlanController::class, 'create']);
    Route::post('/store', [SubscriberPlanController::class, 'store']);
    Route::get('/edit/{id}', [SubscriberPlanController::class, 'edit']);
    Route::post('/update', [SubscriberPlanController::class, 'update']);
    Route::get('/delete/{id}', [SubscriberPlanController::class, 'delete']);
});

Route::prefix('isp')->group(function () {
    Route::get('/', [IspController::class, 'index']);
    Route::get('/create', [IspController::class, 'create']);
    Route::post('/store', [IspController::class, 'store']);
    Route::post('/update', [IspController::class, 'update']);
});

Route::prefix('documents')->group(function(){
    Route::get('/', [DocumentController::class, 'index']);
    Route::get('create', [DocumentController::class, 'create']);
    Route::post('store', [DocumentController::class, 'store']);
    Route::get('view/{customerId}/{step}', [DocumentController::class, 'view']);
    Route::get('edit/{customerId}/{step}', [DocumentController::class, 'edit']);
    Route::post('update', [DocumentController::class, 'update']);
    Route::get('action/{action}/{customerId}', [DocumentController::class, 'action']);
});

Route::prefix('inventory')->group(function(){
    Route::get('/', [InventoryController::class, 'index']);
    Route::get('create', [InventoryController::class, 'create']);
    Route::post('store', [InventoryController::class, 'store']);

    Route::get('view/{id}/', [InventoryController::class, 'view']);
    Route::get('edit/{id}/', [InventoryController::class, 'edit']);
    Route::post('update', [InventoryController::class, 'update']);
    Route::get('delete/{id}', [InventoryController::class, 'delete']);

    Route::prefix('oor')->group(function(){
        Route::get('/', [InventoryController::class, 'indexOOR']);
        Route::post('store', [InventoryController::class, 'storeOOR']);
        Route::post('update', [InventoryController::class, 'updateOOR']);
        Route::get('delete/{id}', [InventoryController::class, 'deleteOOR']);
    });

    Route::prefix('make')->group(function(){
        Route::get('/', [InventoryController::class, 'indexMake']);
        Route::post('store', [InventoryController::class, 'storeMake']);
        Route::post('update', [InventoryController::class, 'updateMake']);
        Route::get('delete/{id}', [InventoryController::class, 'deleteMake']);
    });

    Route::prefix('purchase-from')->group(function(){
        Route::get('/', [InventoryController::class, 'indexPurchaseFrom']);
        Route::post('store', [InventoryController::class, 'storePurchaseFrom']);
        Route::post('update', [InventoryController::class, 'updatePurchaseFrom']);
        Route::get('delete/{id}', [InventoryController::class, 'deletePurchaseFrom']);
    });
});

Route::prefix('settings')->group(function(){
    Route::get('/', function(){
        return view('admin.settings.index');
    });

    Route::group(['prefix' => 'update-app'], function () {
        Route::get('/', [UpdateController::class, 'index']);
        Route::post('/basic', [UpdateController::class, 'basicUpdate']);
        Route::post('/custom-update', [UpdateController::class, 'customUpdate']);
        Route::post('/database', [UpdateController::class, 'databaseUpdate']);
    });

    Route::get('profile', [UserController::class, 'profile']);

    Route::prefix('admin')->group(function(){
        Route::get('/', function(){
            return view('admin.settings.index');
        });
        Route::get('profile', [UserController::class, 'profile']);

        Route::prefix('finance')->group(function(){
            Route::get('/', function(){
                return view('admin.settings.index');
            });
            Route::get('expenses', [UserController::class, 'profile']);


        });
    });
});

Route::get('/exp', function(){
    return p('exp');
});
