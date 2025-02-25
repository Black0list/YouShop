<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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
    return view('welcome');
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
    Route::put('/user/update/{user}', [UserController::class, 'update']);
});

