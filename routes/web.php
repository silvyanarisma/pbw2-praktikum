<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;

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


//Routing Transaction
Route::get('/getAllTransactions', [TransactionController::class, 'getAllTransactions'])->middleware(['auth', 'verified']);

Route::get('/transaksiTambah', [TransactionController::class, 'create'])->middleware(['auth', 'verified'])->name('transaksiTambah');

Route::get('/transaksi', [TransactionController::class, 'index'])->middleware(['auth', 'verified'])->name('transaksi');

Route::post('/transaksiStore', [TransactionController::class, 'store'])->middleware(['auth', 'verified']);

Route::get('/transaksiView/{transaction}', [TransactionController::class, 'show'])->middleware(['auth', 'verified']);


//Routing DetailTransaction
Route::get('/getAllDetailTransactions/{transactionId}', [DetailTransactionController::class, 'getAllDetailTransactions'])->middleware(['auth', 'verified']);

Route::get('/detailTransactionKembalikan/{detailTransactionId}', [DetailTransactionController::class, 'detailTransactionKembalikan'])->middleware(['auth', 'verified']);

Route::post('/detailTransactionUpdate', [DetailTransactionController::class, 'update'])->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
