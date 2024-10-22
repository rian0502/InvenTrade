<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodReceiptController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PeriodeClosing;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitConversionController;
use App\Http\Controllers\UoMController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WarehouseController;
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

Route::resource('master-data/uom', UoMController::class)->names('uom')->except(['show'])->middleware('auth');
Route::resource('master-data/tax', TaxController::class)->names('tax')->except(['show'])->middleware('auth');
Route::resource('master-data/item', ItemController::class)->names('item')->except(['show'])->middleware('auth');
Route::resource('master-data/user', UsersController::class)->names('user')->except(['show'])->middleware('auth');
Route::resource('master-data/period', PeriodeClosing::class)->names('period')->except(['show'])->middleware('auth');
Route::resource('master-data/partner', PartnersController::class)->names('partner')->except(['show'])->middleware('auth');
Route::resource('master-data/category', CategoryController::class)->names('category')->except(['show'])->middleware('auth');
Route::resource('master-data/conversion', UnitConversionController::class)->names('conversion')->except(['show'])->middleware('auth');
Route::resource('master-data/warehouse', WarehouseController::class)->names('warehouse')->except(['show'])->middleware('auth');

Route::resource('inventory/good-receipt', GoodReceiptController::class)->names('gr')->middleware('auth');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/check', [AuthController::class, 'login'])->name('login.check');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
