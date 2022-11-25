<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routing User
Route::get('user', [UserController::class, 'index'])->name('user');

Route::get('userRegistration', [UserController::class, 'create'])->name('userRegistration');

Route::post('userStore', [UserController::class, 'store'])->name('userStore');

Route::get('userView/{user}', [UserController::class, 'show'])->name('userView');

Route::get('/getAllUsers', [UserController::class, 'getAllUsers'])->middleware(['auth', 'verified']);

Route::post('userUpdate', [UserController::class, 'update'])->name('userUpdate');



// Routing Collection
Route::get('koleksi', [CollectionController::class, 'index'])->name('koleksi');

Route::get('koleksiTambah', [CollectionController::class, 'create'])->name('koleksiTambah');

Route::post('koleksiStore', [CollectionController::class, 'store'])->name('koleksiStore');

Route::get('koleksiView/{collection}', [CollectionController::class, 'show'])->name('koleksiView');

Route::get('/getAllCollections', [CollectionController::class, 'getAllCollections'])->middleware(['auth', 'verified']);

Route::post('koleksiUpdate', [CollectionController::class, 'update'])->name('collectionUpdate');

require __DIR__.'/auth.php';
