<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

require_once __DIR__."/admin.php";
require_once __DIR__."/user.php";


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['adminMiddleware'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/run-migration', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh --force');
    return "Database migrated successfully!";
});

require __DIR__.'/auth.php';

//social login

Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect']);
Route::get('/auth/{provider}/callback',[SocialLoginController::class, 'callback']);
