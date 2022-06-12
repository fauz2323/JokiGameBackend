<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\UserJoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageUserController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = UserJoki::find(Auth::user()->id);
        $message = $user->message()->create([
            'from' => $user->username,
            'message' => $request->message,
            'status' => 'unread',
        ]);

        return response()->json(
            $message,
            200
        );
    }

    public function getMessage()
    {
        $message = Message::where('user_id', Auth::user()->id)->get();

        return response()->json(
            $message,
            200
        );
    }
}
