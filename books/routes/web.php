<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Middleware\CheckRole;
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

Route::prefix('admin')->middleware([CheckRole::class])->group(function(){
    Route::get('store', [BooksController::class, 'store'])->name('store');
    Route::post('create', [BooksController::class, 'create'])->name('create');
    Route::get('delete', [BooksController::class, 'delete'])->name('delete');
    Route::get('edit', [BooksController::class, 'edit'])->name('edit');
    Route::post('update', [BooksController::class, 'update'])->name('update');
    Route::get('/', [BooksController::class, 'test'])->name('test');

}) ;



Route::prefix('/')->group(function(){
    Route::get('/', [BooksController::class, 'index'])->name('index');
    Route::get('cart', [BooksController::class, 'cart'])->name('cart');
    Route::get('login', [BooksController::class, 'login'])->name('login');
    Route::post('check_login', [BooksController::class, 'check_login'])->name('check_login');
    Route::post('change-to-cart', [BooksController::class, 'changetocart'])->name('change-to-cart');
    Route::get('detail', [BooksController::class, 'detail'])->name('detail');
    Route::post('display-to-cart', [BooksController::class, 'displaytocar'])->name('display-to-cart');
    Route::post('add-to-cart', [BooksController::class, 'addtocart'])->name('add-to-cart');
    Route::post('order', [BooksController::class, 'order'])->name('order');
    Route::post('check_oder', [BooksController::class, 'check_oder'])->name('check_oder');
    Route::get('list_order', [BooksController::class, 'list_order'])->name('list_order');
    Route::post('comment', [BooksController::class, 'comment'])->name('comment');
    Route::post('deletecomment', [BooksController::class, 'deletecomment'])->name('deletecomment');
    Route::get('logout', [BooksController::class, 'logout'])->name('logout');
    Route::get('signup', [BooksController::class, 'signup'])->name('signup');
    Route::post('check_signup', [BooksController::class, 'check_signup'])->name('check_signup');


});
