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
}
