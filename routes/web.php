<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorPayController;

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
    return view('pages.product.index');
});

// Product
Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/products/export', [ProductController::class, 'exportExcel'])->name('export');

    // Razorpay Payment
    Route::group(['prefix' => 'buy', 'as' => 'buy.'], function () {
        Route::post('/payment', [RazorPayController::class, 'payment'])->name('payment');
        Route::get('/success', [RazorPayController::class, 'success'])->name('success');
    });
});
