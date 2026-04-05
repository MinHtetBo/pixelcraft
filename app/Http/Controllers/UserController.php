<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;


class UserController extends Controller
{
    //direct user home page
    public function home(){
        $products = Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as categories_name')
                        ->leftJoin('categories','products.categories_id','categories.id')
                        ->orderBy('products.created_at', 'desc')
                        ->get();

        $categories = Category::select('id','name')->get();
          return view('user.dashboard.home', compact('products','categories'));
    }
}
