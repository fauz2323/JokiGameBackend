<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class GameAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Game::all();

            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="game-edit/' . Crypt::encrypt($row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a> | <a href="game-delete/' . Crypt::encrypt($row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-danger btn-sm editCustomer">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.category.index');
    }

    public function delete($id)
    {
        $data = Game::find(Crypt::decrypt($id));
        // $check = $data->product->first();

        // if ($check) {
        // return redirect()->back()->with('err', 'error delete, game list has product');

        // }

        $data->delete();

        return redirect()->back()->with('success', 'success delete list game');
    }

    public function add(Request $request)
    {
        $request->validate([
            'game' => 'required',
            'image' => 'required'
        ]);

        $path = Storage::disk('public')->putFile('filez', $request->file('image'));

        $data = Game::create([
            'name' => $request->game,
            'ImagePath' => $path
        ]);

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'game' => 'required',
        ]);

        $data = Game::find($id);

        if ($request->file('image')) {
            Storage::delete($data->ImagePath);
            $path = Storage::disk('public')->putFile('filez', $request->file('image'));

            $data->update([
                'name' => $request->game,
                'ImagePath' => $path
            ]);

            return redirect()->route('game-index');
        }

        $data->update([
            'name' => $request->game,
        ]);

        return redirect()->route('game-index');
    }

    public function editView($id)
    {
        $data = Game::find(Crypt::decrypt($id));

        return view('admin.category.edit', compact('data'));
    }
}
