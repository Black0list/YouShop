<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
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
    return redirect('products');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Route::prefix('admin')->group(function () {
//================================= ROLES ===================================
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/role/create', [RoleController::class, 'create']);
    Route::delete('/role/delete/{role}', [RoleController::class, 'delete']);
    Route::put('/role/update/{role}', [RoleController::class, 'update']);
    Route::get('/role/get/{role}', [RoleController::class, 'getRole']);

//================================= USERS ===================================
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/user/update', [UserController::class, 'setRole']);

    //================================= CATEGORIES ===================================
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/category/get', [CategoryController::class, 'getOne']);
    Route::post('/category/create', [CategoryController::class, 'create']);
    Route::put('/category/update', [CategoryController::class, 'update']);
    Route::delete('/category/delete', [CategoryController::class, 'delete']);

    //================================= SUBCATEGORIES ===================================
    Route::get('/subcategories', [SubCategoryController::class, 'index']);
    Route::post('/subcategory/get', [SubCategoryController::class, 'getOne']);
    Route::post('/subcategory/create', [SubCategoryController::class, 'create']);
    Route::put('/subcategory/update', [SubCategoryController::class, 'update']);
    Route::delete('/subcategory/delete', [SubCategoryController::class, 'delete']);

//================================= PRODUCTS ===================================
    Route::get('/products', [ProductController::class, 'index']);
    Route::delete('/product/delete', [ProductController::class, 'delete']);
    Route::post('/product/create', [ProductController::class, 'create']);
    Route::put('/product/update', [ProductController::class, 'update']);
    Route::post('/product/get', [ProductController::class, 'getOne']);

});

Route::get('/products', [ProductController::class, 'home']);
Route::post('/products/view', [ProductController::class, 'view']);
Route::post('/products/get', [ProductController::class, 'getItems']);
Route::post('/command/pay', [ProductController::class, 'pay']);

Route::controller(StripeController::class)->group(function(){
    Route::post('/pay', 'pay');
    Route::post('/command/pay', 'stripePost')->name('stripe.post');
});
