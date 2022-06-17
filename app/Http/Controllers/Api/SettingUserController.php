<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserJoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingUserController extends Controller
{
    public function changePass(Request $request)
    {
        $user = UserJoki::find(Auth::user()->id);

        if (Hash::check($request->newPass, $user->password)) {
            $user->password = Hash::make($request->newPass);
            $user->save();

            return response()->json([
                'message' => 'success',
            ], 200);
        }

        return response()->json([
            'message' => 'old password not match',
        ], 200);
    }

    public function changeMail(Request $request)
    {
        $user = UserJoki::find(Auth::user()->id);

        if (Hash::check($request->password, $user->password)) {
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'message' => 'success',
            ], 200);
        }

        return response()->json([
            'message' => 'password not match',
        ], 200);
    }

    public function changeName(Request $request)
    {
        $user = UserJoki::find(Auth::user()->id);

        if (Hash::check($request->password, $user->password)) {
            $user->name = $request->name;
            $user->save();

            return response()->json([
                'message' => 'success',
            ], 200);
        }

        return response()->json([
            'message' => 'password not match',
        ], 200);
    }
}
