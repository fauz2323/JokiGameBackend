<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $about = About::first();
        return view('admin.about.about', compact('about'));
    }

    public function storAbout(Request $request)
    {
        $about = About::first();
        $about->about = $request->about;
        $about->save();

        return redirect()->back()->with('success', 'success change about');
    }
}
