<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('admin.setting.index', compact('user'));
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = User::find(Auth::user()->id);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back();
    }
}
