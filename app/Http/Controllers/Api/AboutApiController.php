<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutApiController extends Controller
{
    public function getAbout()
    {
        $about = About::first();
        return response()->json([
            'about' => $about->about,
        ], 200);
    }
}
