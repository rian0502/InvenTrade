<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodReceiptController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PeriodeClosing;
use App\Http\Controllers\PosNewSaleController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitConversionController;
use App\Http\Controllers\UoMController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;


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



Route::middleware('auth')->prefix('inventory')->group(function () {
    Route::get('good-receipt', [GoodReceiptController::class, 'index'])->name('gr.index');
    Route::get('good-receipt/create/{id}', [GoodReceiptController::class, 'create'])->name('gr.create');
    Route::post('good-receipt/store', [GoodReceiptController::class, 'store'])->name('gr.store');
    Route::get('good-receipt/show/{id}', [GoodReceiptController::class, 'show'])->name('gr.show');
    Route::get('good-receipt/edit/{id}', [GoodReceiptController::class, 'edit'])->name('gr.edit');
    Route::put('good-receipt/update/{id}', [GoodReceiptController::class, 'update'])->name('gr.update');
    Route::delete('good-receipt/destroy/{id}', [GoodReceiptController::class, 'destroy'])->name('gr.destroy');
});

Route::resource('inventory/good-issue', GoodReceiptController::class)->names('gi')->middleware('auth');


Route::get('inventory/items', [InventoryItemController::class, 'index'])->name('inventory.index');

//POS
Route::middleware('auth')->prefix('pos')->group(function () {
    Route::resource('new-sale', PosNewSaleController::class)->names('new-sale');
});


Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/check', [AuthController::class, 'login'])->name('login.check');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
