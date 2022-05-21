<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use App\Models\UserJoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TopUpController extends Controller
{

    public function all()
    {
        $data = TopUp::where('id_akun', Auth::user()->id)->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function topUp(Request $request)
    {
        $auth = Auth::user();
        $codeUniq = rand(100, 999);

        $data = TopUp::create([
            'id_akun' => $auth->id,
            'codeUniq' => $codeUniq,
            'total' => $request->total,
            'ket' => $request->ket,
            'status' => 'pending',
            'path' => '-'
        ]);

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function upload(Request $request, $id)
    {
        if ($request->image) {
            $path = Storage::disk('public')->putFile('upload', $request->file('image'));
            $data = TopUp::find($id);
            $data->update([
                'status' => 'dicek',
                'path' => $path
            ]);

            return response()->json([
                'status' => 'done',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'fail',
            'data' => 'none'
        ], 200);
    }
}
