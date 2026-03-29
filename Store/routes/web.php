<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , [WelcomeController::class , 'welcome'])->name('welcome');
Route::get('/cart' , [WelcomeController::class , 'cart'])->name('cart');
Route::post('/store/{id}', [WelcomeController::class, 'store']);
Route::get('/shop' , [WelcomeController::class , 'shop'])->name('shop');
Route::post('/cart/{id}/{type}', [WelcomeController::class, 'updateCart']);
Route::delete('/delete/{id}', [WelcomeController::class, 'destroy'])->name('del');
Route::get('/about' , function () {
    return view('about');
});
Route::get('/contact' , function () {
    return view('contact');
});










Route::resource('user', UserController::class);
Route::resource('admin', StoreController::class);

Route::get('/dashboard/{id}', [StoreController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
