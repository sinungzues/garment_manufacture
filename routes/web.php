<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PpnController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderDetailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\UserController;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;














/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware('auth');


Route::resource('user', UserController::class)->middleware('auth');
Route::resource('role', RoleController::class)->middleware('auth');
Route::resource('permissions', PermissionController::class)->middleware('auth');

Route::resource('/suplier', SuplierController::class)->middleware('auth');
Route::resource('/departement', DepartementController::class)->middleware(['auth']);
Route::resource('/satuan', SatuanController::class)->middleware(['auth']);
Route::resource('/currency', CurrencyController::class)->middleware(['auth']);
Route::resource('/ppn', PpnController::class)->middleware('auth');
Route::get('/refresh/{id}', [UserController::class, 'refresh']);

Route::resource('/purchaseorder', PurchaseOrderController::class)->middleware('auth');
Route::get('/purchaseorder/restore/{id}', [PurchaseOrderController::class, 'restore']);
Route::get('/purchaseorder/approve/{id}', [PurchaseOrderController::class, 'approve']);
Route::get('/purchaseorder/notapprove/{id}', [PurchaseOrderController::class, 'notapprove']);
Route::get('/purchaseorder/cancel-approve/{id}', [PurchaseOrderController::class, 'cancel']);
Route::resource('/purchaseorderdet', PurchaseOrderDetailController::class)->middleware('auth');
Route::get('/purchaseorderdet/create/{purchaseOrder}', [PurchaseOrderDetailController::class, 'create'])->middleware('auth');
Route::get('/view-excel/{id}', [PurchaseOrderController::class, 'viewExcel']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/log', function () {
    // $logs = DB::table('log_activities')->latest();
    $logs = LogActivity::with('user')->get();
    return view('log',[
        'logs' => $logs
    ]);
})->middleware('auth');
