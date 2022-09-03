<?php

namespace App\Http\Controllers;

use App\Models\BalanceUser;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use App\Models\UserJoki;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = UserJoki::all();
        $balance = BalanceUser::all();
        $order = Order::all();
        $message = Message::all();
        return view('home', compact('user', 'balance', 'order', 'message'));
    }
}
