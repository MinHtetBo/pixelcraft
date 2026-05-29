<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment_History;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //direct admin dashboard
    public function dashboard(){
        $userCount = User::where('role','user')->count();
         $adminCount = User::where('role','admin')->count();
         $categoryCount = Category::count();
        $orderCount = Order::whereIn('status',['preparing','success'])->count();
        $rejectCount = Order::whereIn('status',['rejected'])->count();
        $totalTransationAmount = Payment_History::sum('total_amount');
        $totalOrderSuccessAmount = Order::where('status','success')->sum('total_price');
         return view("admin.dashboard.home", compact('userCount','orderCount','rejectCount','adminCount','totalTransationAmount','totalOrderSuccessAmount','categoryCount'));
    }
}
