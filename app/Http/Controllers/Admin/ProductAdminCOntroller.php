<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class ProductAdminCOntroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $game = Game::all();
        if ($request->ajax()) {
            $data = Product::with('game')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="product-edit/' . $row->id . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a> | <a href="product-delete/' . Crypt::encrypt($row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-danger btn-sm editCustomer">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.product.index', compact('game'));
    }

    public function add(Request $request)
    {
        $data = Product::create([
            'game_id' => $request->game_id,
            'productName' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);

        return redirect()->back();
    }

    public function view($id)
    {
        $data = Product::find($id);
        $game = Game::all();

        return view('admin.product.edit', compact('data', 'game'));
    }

    public function store(Request $request, $id)
    {
        $data = Product::find($id);

        $data->update([
            'game_id' => $request->game_id,
            'productName' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);

        return redirect()->route('product-index');
    }

    public function delete($id)
    {
        $data = Product::find(Crypt::decrypt($id));

        $data->delete();

        return redirect()->back();
    }
}
