<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodReceiptController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PeriodeClosing;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitConversionController;
use App\Http\Controllers\UoMController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WarehouseController;
use App\Models\PurchaseOrderModel;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

/* Start Master Data */
Route::middleware('auth')->prefix('master-data')->group(function () {
    Route::resource('uom', UoMController::class)->names('uom')->except(['show']);
    Route::resource('tax', TaxController::class)->names('tax')->except(['show']);
    Route::resource('item', ItemController::class)->names('item')->except(['show']);
    Route::resource('user', UsersController::class)->names('user')->except(['show']);
    Route::resource('period', PeriodeClosing::class)->names('period')->except(['show']);
    Route::resource('partner', PartnersController::class)->names('partner')->except(['show']);
    Route::resource('category', CategoryController::class)->names('category')->except(['show']);
    Route::resource('conversion', UnitConversionController::class)->names('conversion')->except(['show']);
    Route::resource('warehouse', WarehouseController::class)->names('warehouse')->except(['show']);
});
/* End Master Data */

/* Start Procurement Management */
Route::resource('purchase-order', PurchaseOrderController::class)->names('po')->middleware('auth');
/* End Procurement Management */



Route::resource('inventory/good-receipt', GoodReceiptController::class)->names('gr')->middleware('auth');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/check', [AuthController::class, 'login'])->name('login.check');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
