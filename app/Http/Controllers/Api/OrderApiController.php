<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserJoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderApiController extends Controller
{
    public function makeOrder(Request $request)
    {
        $product = Product::find($request->id_product);
        $user = UserJoki::find(Auth::user()->id);

        if ($product) {

            if ($user->balance->balance <= $product->price) {
                return response()->json([
                    'status' => 'insufficient balance',
                ], 201);
            }
            $user->balance->balance = $user->balance->balance - $product->price;
            $user->balance->save();

            $order = Order::create([
                'product_id' => $request->id_product,
                'user_id' => $user->id,
                'note' => $request->note,
                'price' => $product->price,
                'status' => 'menunggu',
            ]);

            return response()->json([
                'status' => 'success',
                'product' => $product,
                'orderDetail' => $order,
            ], 200);
        }

        return response()->json([
            'status' => 'failed fetch data product',
            'product' => '',
            'orderDetail' => '-',
        ], 302);
    }

    public function orderList()
    {
        $order = Order::where('user_id', Auth::user()->id)->with('product')->get();
        return response()->json([
            'status' => 'success',
            'orderList' => $order,
        ], 200);
    }

    public function orderDetail(Request $request)
    {
        $order = Order::where('id', $request->id)->with('user', 'product')->first();

        return response()->json([
            'status' => 'ok',
            'orderList' => $order,
        ], 200);
    }
}
