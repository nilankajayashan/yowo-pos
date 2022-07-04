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

Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth_employee');
Route::post('add-category', [\App\Http\Controllers\CategoryController::class, 'add'])->name('add-category')->middleware('auth_employee');
Route::post('edit-category', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('edit-category')->middleware('auth_employee');
Route::post('delete-category', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('delete-category')->middleware('auth_employee');
Route::post('change-status-category', [\App\Http\Controllers\CategoryController::class, 'changeStatus'])->name('change-status-category')->middleware('auth_employee');

Route::post('add-user', [\App\Http\Controllers\UserController::class, 'add'])->name('add-user')->middleware('auth_employee');
Route::post('edit-user', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit-user')->middleware('auth_employee');
Route::post('delete-user', [\App\Http\Controllers\UserController::class, 'delete'])->name('delete-user')->middleware('auth_employee');

Route::post('add-product', [\App\Http\Controllers\ProductController::class, 'add'])->name('add-product')->middleware('auth_employee');
Route::post('change-status-product', [\App\Http\Controllers\ProductController::class, 'changeStatus'])->name('change-status-product')->middleware('auth_employee');
Route::post('edit-product', [\App\Http\Controllers\ProductController::class, 'edit'])->name('edit-product')->middleware('auth_employee');
Route::post('delete-product', [\App\Http\Controllers\ProductController::class, 'delete'])->name('delete-product')->middleware('auth_employee');
Route::post('update-product-stock', [\App\Http\Controllers\ProductController::class, 'updateStock'])->name('update-product-stock')->middleware('auth_employee');

Route::post('add-employee', [\App\Http\Controllers\EmployeeController::class, 'add'])->name('add-employee')->middleware('auth_employee');
Route::post('change-status-employee', [\App\Http\Controllers\EmployeeController::class, 'changeStatus'])->name('change-status-employee')->middleware('auth_employee');
Route::post('delete-employee', [\App\Http\Controllers\EmployeeController::class, 'delete'])->name('delete-employee')->middleware('auth_employee');
Route::post('edit-employee', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('edit-employee')->middleware('auth_employee');
Route::post('update-employee-account', [\App\Http\Controllers\EmployeeController::class, 'accountUpdate'])->name('update-employee-account')->middleware('auth_employee');
Route::post('upload-employee-profile', [\App\Http\Controllers\EmployeeController::class, 'ProfileUpdate'])->name('upload-employee-profile')->middleware('auth_employee');

Route::post('delete-cart', [\App\Http\Controllers\CartController::class, 'delete'])->name('delete-cart')->middleware('auth_employee');
Route::post('edit-cart-view', [\App\Http\Controllers\CartController::class, 'editView'])->name('edit-cart-view')->middleware('auth_employee');
Route::post('remove-item-cart', [\App\Http\Controllers\CartController::class, 'removeItemCart'])->name('remove-item-cart')->middleware('auth_employee');
Route::post('update-item-cart', [\App\Http\Controllers\CartController::class, 'updateItemCart'])->name('update-item-cart')->middleware('auth_employee');
Route::post('add-to-cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('add-to-cart')->middleware('auth_employee');

Route::post('add-order', [\App\Http\Controllers\OrderController::class, 'add'])->name('add-order')->middleware('auth_employee');
Route::post('edit-order', [\App\Http\Controllers\OrderController::class, 'edit'])->name('edit-order')->middleware('auth_employee');
Route::post('delete-order', [\App\Http\Controllers\OrderController::class, 'delete'])->name('delete-order')->middleware('auth_employee');
Route::post('manage-order', [\App\Http\Controllers\OrderController::class, 'manage'])->name('manage-order')->middleware('auth_employee');

Route::post('add-to-bill', [\App\Http\Controllers\SaleController::class, 'addToBill'])->name('add-to-bill')->middleware('auth_employee');
Route::post('delete-from-bill', [\App\Http\Controllers\SaleController::class, 'removeFromBill'])->name('delete-from-bill')->middleware('auth_employee');
Route::post('update-bill', [\App\Http\Controllers\SaleController::class, 'updateBill'])->name('update-bill')->middleware('auth_employee');
Route::get('clear-bill', [\App\Http\Controllers\SaleController::class, 'clearBill'])->name('clear-bill')->middleware('auth_employee');
Route::post('make-bill', [\App\Http\Controllers\BillController::class, 'makeBill'])->name('make-bill')->middleware('auth_employee');
Route::post('delete-bill', [\App\Http\Controllers\BillController::class, 'deleteBill'])->name('delete-bill')->middleware('auth_employee');

Route::get('login', [\App\Http\Controllers\LoginController::class, 'loginView'])->name('login');
Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('login-submit', [\App\Http\Controllers\LoginController::class, 'loginSubmit'])->name('login-submit');

Route::get('admin-register', [\App\Http\Controllers\AdminRegisterController::class, 'adminRegisterView'])->name('admin-register');
Route::post('admin-register-submit', [\App\Http\Controllers\AdminRegisterController::class, 'adminRegisterSubmit'])->name('admin-register-submit');

Route::post('order-download', [\App\Http\Controllers\PDFController::class, 'downloadOrder'])->name('order-download')->middleware('auth_employee');
Route::post('bill-download', [\App\Http\Controllers\PDFController::class, 'downloadBill'])->name('bill-download')->middleware('auth_employee');
Route::post('generate-barcode', [\App\Http\Controllers\BarCodeController::class, 'generateBarcode'])->name('generate-barcode')->middleware('auth_employee');


Route::post('update-web-color', [\App\Http\Controllers\WebController::class, 'updateColor'])->name('update-web-color')->middleware('auth_employee');
Route::post('update-shop-details', [\App\Http\Controllers\WebController::class, 'updateBasicShopDetails'])->name('update-shop-details')->middleware('auth_employee');
Route::post('update-shop-social-links', [\App\Http\Controllers\WebController::class, 'updateShopSocialLinks'])->name('update-shop-social-links')->middleware('auth_employee');


