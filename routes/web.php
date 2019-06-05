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
    return view('dashboard');
});

Route::resource('supplier', 'SupplierController');

Route::prefix('product')->name('product.')->group(function () {
    Route::resource('unit', 'ProductUnitController');
    Route::resource('category', 'ProductCategoryController');
    Route::resource('item', 'ProductItemController');

    Route::prefix('item')->name('product.item.')->group(function () {
        Route::post('/check-code', ['uses' => 'ProductItemController@checkCode']);
    });
});

Route::resource('shop', 'ShopController');

Route::resource('customer', 'CustomerController');

Route::prefix('transaction')->name('transaction.')->group(function () {
    Route::resource('purchase', 'PurchaseController');
    Route::resource('selling', 'SellingController');

    // Purchase
    Route::prefix('purchase')->name('purchase.')->group(function(){
        Route::post('/insert', 'PurchaseController@insert')->name('insert');
        Route::post('/create-detail', 'PurchaseController@detailInsert')->name('detail.create');
        Route::post('/update-detail/{id}', 'PurchaseController@detailUpdate')->name('detail.update');
        Route::get('/delete-detail/{id}', 'PurchaseController@detailDelete')->name('detail.delete');
        Route::get('/detail/{id}', 'PurchaseController@detail')->name('detail.index');
    });

    // Selling
    Route::prefix('selling')->name('selling.')->group(function(){
        Route::post('/create-detail', 'SellingController@detailInsert')->name('detail.create');
    });
});
