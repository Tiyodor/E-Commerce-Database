<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
{
    $users = User::latest()->paginate(5);
    $products = Product::latest()->paginate(5);
    $orders = Order::latest()->paginate(5);

    return view('home', compact('users', 'products', 'orders'));
}


}
