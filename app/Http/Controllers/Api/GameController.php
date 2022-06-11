<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Portofolio;
use App\Models\Product;
use App\Models\ProductImage;
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
        if ($request->game == 'all') {
            $list = Product::with('image')->get();
        } else {
            $data = Game::where('name', $request->game)->first();
            $list = Product::where('game_id', $data->id)->with('image')->get();
        }

        return response()->json([
            'game' => $request->game,
            'list' => $list,
        ], 200);
    }

    public function productDetail(Request $request)
    {
        $data = Product::find($request->id);
        $etalase = Game::find($data->game_id);

        return response()->json([
            'data' => $data,
            'game' => $etalase->name,
        ], 200);
    }

    public function getPortofolio(Request $request)
    {
        $porto = Portofolio::select('path')->where('id_product', $request->id)->get();

        if ($porto->isEmpty()) {
            $porto = ['path' => '-'];
            return response()->json([
                'data' => '-',
                'porto' => [$porto],
            ], 200);
        } else {
            return response()->json([
                'data' => 'success',
                'porto' => $porto,
            ], 200);
        }
    }

    public function getImage(Request $request)
    {
        $porto = ProductImage::select('path')->where('id_product', $request->id)->get();

        if ($porto->isEmpty()) {
            $porto = ['path' => '-'];
            return response()->json([
                'data' => '-',
                'image' => $porto,
            ], 200);
        } else {
            return response()->json([
                'data' => 'success',
                'image' => $porto,
            ], 200);
        }
    }


    //disable
    public function productAll()
    {
        $data = Game::all();
        return response()->json([
            'game' => 'all',
            'list' => $data,
        ], 200);
    }
}
