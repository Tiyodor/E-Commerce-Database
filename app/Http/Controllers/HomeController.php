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
    $users = User::latest()->paginate(4);
    $products = Product::latest()->paginate(3);
    $orders = Order::latest()->paginate(3);

    return view('home', compact('users', 'products', 'orders'));
}


}
