<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function gameList()
    {
        $data = Game::all();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function product(Request $request)
    {
        $data = Game::where('name', $request->game)->first();

        return response()->json([
            'game' => $data->name,
            'list' => $data->product,
        ], 200);
    }

    public function productDetail(Request $request)
    {
        $data = Product::find($request->id);

        return response()->json([
            'product' => $data->productName,
            'data' => $data,
            'portopolio' => $data->portofolio
        ], 200);
    }



    public function productAll()
    {
        $data = Game::all();
        return response()->json([
            'game' => 'all',
            'list' => $data,
        ], 200);
    }
}
