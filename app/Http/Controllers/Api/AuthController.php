<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserJoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $usernameCheck = UserJoki::where('username', $request->username)->first();
        $mailCheck = UserJoki::where('email', $request->email)->first();

        if ($usernameCheck) {
            return response()->json([
                'message' => 'username has been used',
                'code' => '000',
            ], 200);
        } else {
            if ($mailCheck) {
                return response()->json([
                    'message' => 'email has been used',
                    'code' => '001',
                ], 200);
            } else {
                $user = UserJoki::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                ]);

                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([
                    'message' => 'Success Register',
                    'code' => '002',
                    'data' => [
                        'token' => $token,
                        'username' => $user->username,
                        'phone' => $user->phone,
                        'email' => $user->email,
                    ]
                ], 200);
            }
        }
    }

    public function login(Request $request)
    {
        $user = UserJoki::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->tokens()->delete();
            $token = $user->createToken('user_token')->plainTextToken;
            return response()->json([
                'message' => 'success login',
                'code' => '001',
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'user/password not found',
                'code' => '000'
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logout success'
        ], 200);
    }
}
