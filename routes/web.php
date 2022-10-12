<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\{
                            CustomAuthController,
                            SaleController,
                            InvoiceController,
                            CustomerController,
                            PurchaseController
                        };

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
    return view('auth.login');
});
Route::get('/welcome1', function () {
    return view('welcome1');

});
Route::get('/welcome', function () {
    return view('welcome');

});
Route::get('/addprices', function () {
    return view('addprices');
});


Route::post('products/json/search',[ProductController::class,'postSearch'])->name('products.search');

Route::get('products/search', [ProductController::class,'search'])->name('product.search');

Route::resource('products', ProductController::class);

Route::resource('category', CategoryController::class);
Route::resource('brand', BrandsController::class);

Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

//Route::post('search','ProductController@Search')->name('search');

/* Sales */

Route::get('/sales', [SaleController::class,'index'])->name('sales.index');


/* Invoice */

Route::get('/invoice', [InvoiceController::class,'index'])->name('invoice.index');
Route::get('/invoice/create',[InvoiceController::class,'create'])->name('invoice.create');
Route::post('/invoice', [InvoiceController::class,'store'])->name('invoice.store');

Route::get('/invoice/{id}', [InvoiceController::class,'show'])->name('invoice.show');

Route::get('/invoice/{id}/edit', [InvoiceController::class,'edit'])->name('invoice.edit');
Route::put('/invoice/{id}/edit', [InvoiceController::class,'update'])->name('invoice.update');

Route::delete('/invoice/{id}/delete',[InvoiceController::class,'destroy'])->name('invoice.destroy');


Route::post('pdf',[InvoiceController::class,'convert'])->name('invoice.pdf');


Route::resource('customer', CustomerController::class);

Route::resource('purchase', PurchaseController::class);