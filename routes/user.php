
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'userMiddleware', 'prefix'=>'user'],function(){
 Route::get('/home',[UserController::class, 'home'])->name('user.home');
 Route::get('/edit', [UserController::class, 'edit'])->name('user#edit');
 Route::post('/update/{id}', [UserController::class, 'update'])->name('user#update');
 Route::get('/change/password', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
 Route::post('/change/password', [UserController::class, 'changePassword'])->name('user#changePassword');
 Route::get('/product/details/{id}', [UserController::class, 'productDetails'])->name('user#productDetails');
 Route::post('/comment', [UserController::class, 'comment'])->name('user#comment');
 Route::get('/comment/delete/{id}', [UserController::class, 'deleteComment'])->name('user#deleteComment');
 Route::post('/rating', [UserController::class, 'rating'])->name('user#rating');
 Route::get('/cart',[UserController::class, 'cart'] )->name('user#cart');
 Route::post('/addToCart',[UserController::class, 'addToCart'] )->name('user#addToCart');
 Route::get('/deleteCart',[UserController::class, 'deleteCart'] )->name('user#deleteCart');
 Route::get('/payment/page',[UserController::class, 'paymentPage'] )->name('user#paymentPage');
 Route::get('/cart/temp',[UserController::class, 'cartTemp'] )->name('user#cartTemp');
 Route::post('/payment',[UserController::class, 'payment'] )->name('user#payment');
 Route::get('/myOrder',[UserController::class, 'myOrder'] )->name('user#myOrder');
 Route::get('/contact/page',[UserController::class, 'contactPage'] )->name('user#contactPage');
 Route::post('/contact',[UserController::class, 'contact'] )->name('user#contact');
});

