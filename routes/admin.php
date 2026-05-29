
<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleInformationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'adminMiddleware', 'prefix' => 'admin'], function () {
    Route::get('/home', [AdminDashboardController::class, 'dashboard'])->name("adminDashboard");

    // category
    Route::group(['prefix' => 'category'], function () {
        Route::get('/list', [CategoryController::class, 'list'])->name('category#list');
        Route::post('/create', [CategoryController::class, 'create'])->name('category#create');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category#update');
    });

    // product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/list', [ProductController::class, 'list'])->name('product#list');
        Route::get('/create', [ProductController::class, 'createPage'])->name('product#createPage');
        Route::post('/create', [ProductController::class, 'create'])->name('product#create');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product#update');
    });

    // profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/details', [AdminProfileController::class, 'details'])->name('profile#details');
        Route::get('/edit', [AdminProfileController::class, 'edit'])->name('profile#edit');
        Route::post('/update/{id}', [AdminProfileController::class, 'update'])->name('profile#update');
        Route::get('/change/password', [AdminProfileController::class, 'changePasswordPage'])->name('change#passwordPage');
        Route::post('/change/password', [AdminProfileController::class, 'changePassword'])->name('change#password');

    Route::group(['middleware'=>'superadminMiddleware'], function() {
         Route::get('/add/adminAccount', [AdminProfileController::class, 'addNewAdminPage'])->name('profile#addNewAdminPage');
        Route::post('/add/adminAccount', [AdminProfileController::class, 'addNewAdmin'])->name('profile#addNewAdmin');
        Route::get('/{accountType}/list', [AdminProfileController::class, 'accountList'])->name('profile#accountList');
         Route::get('/delete/{id}', [AdminProfileController::class, 'delete'])->name('profile#delete');
         Route::get('/payment', [AdminProfileController::class, 'paymentPage'])->name('profile#paymentPage');
          Route::post('/payment', [AdminProfileController::class, 'payment'])->name('profile#payment');
    });

    //order
    Route::group(['prefix' => 'order'], function () {
       Route::get('/orderList/{state?}',[OrderController::class,'orderList'])->name('admin#orderList');
       Route::get('/details/{orderCode}',[OrderController::class,'orderdetails'])->name('admin#orderdetails');
       Route::get('/reject/{orderCode}',[OrderController::class,'orderReject'])->name('admin#orderReject');
       Route::get('/accept',[OrderController::class,'orderAccept'])->name('admin#orderAccept');

    });

    //sale information
    Route::group(['prefix' => 'sale'], function () {
       Route::get('/information',[SaleInformationController::class,'saleInformation'])->name('admin#saleInformation');
    });

    });
});
