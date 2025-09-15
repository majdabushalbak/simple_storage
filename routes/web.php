<?php

use App\Http\Controllers\Repairs;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarIDController;
use App\Http\Controllers\RepairNoteController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth.custom')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/product-list', [ProductController::class, 'list'])->name('products.list');
    Route::post('/products/{product}/update-quantity', [ProductController::class, 'updateQuantity'])->name('products.updateQuantity');
    Route::get('products/table/{index}', [ProductController::class, 'getTable']);
});


Route::middleware('auth.custom')->group(function () {

    // CAR (repairs table) routes
    Route::get('/repairs', [CarIDController::class, 'index'])->name('repairs.index');
    Route::get('/repairs/create', [CarIDController::class, 'create'])->name('repairs.createID');
    Route::post('/repairs', [CarIDController::class, 'store'])->name('repairs.storeID');
    Route::get('/repairs/{repair}/edit', [CarIDController::class, 'edit'])->name('repairs.editID');
    Route::put('/repairs/{repair}', [CarIDController::class, 'update'])->name('repairs.updateID');
    Route::delete('/repairs/{repair}', [CarIDController::class, 'destroy'])->name('repairs.destroyID');

    // NOTE (repair_notes table) routes
    Route::get('/repairs/{repair}/notes/create', [RepairNoteController::class, 'create'])->name('repairs.notes.create');
    Route::post('/repairs/{repair}/notes', [RepairNoteController::class, 'store'])->name('repairs.notes.store');
    Route::get('/notes/{note}/edit', [RepairNoteController::class, 'edit'])->name('repairs.notes.edit');
    Route::put('/notes/{note}', [RepairNoteController::class, 'update'])->name('repairs.notes.update');
    Route::delete('/notes/{note}', [RepairNoteController::class, 'destroy'])->name('repairs.notes.destroy');


    // Show a single car and its notes
    Route::get('/repairs/{repair}', [CarIDController::class, 'show'])->name('repairs.show');




});

require __DIR__.'/auth.php';
