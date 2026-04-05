
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'userMiddleware', 'prefix'=>'user'],function(){
 Route::get('/home',[UserController::class, 'home'])->name('userDashboard');
});

