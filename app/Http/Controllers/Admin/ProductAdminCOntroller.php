<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Portofolio;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
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
                    $btn = '<a href="product-edit/' . $row->id . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a> | <a href="product-delete/' . Crypt::encrypt($row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-danger btn-sm editCustomer">Delete</a> | <a href="product-detail/' . $row->id . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Detail</a>';
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

        foreach ($request->file('image') as $key) {
            $path = Storage::disk('public')->putFile('product', $key);

            $data->image()->create([
                'path' => $path
            ]);
        }

        return redirect()->back();
    }

    public function viewDetail($id)
    {
        $product = Product::find($id);
        $porto = Portofolio::where('id_product', $product->id)->get();
        return view('admin.product.view', compact('product', 'porto'));
    }

    public function portofolio(Request $request, $id)
    {
        $data = Product::find($id);

        foreach ($request->file('image') as $key) {
            $path = Storage::disk('public')->putFile('portofolio', $key);

            $data->portofolio()->create([
                'name' => $data->productName,
                'path' => $path
            ]);
        }

        return redirect()->back();
    }

    public function deletePorto($id)
    {
        $porto = Portofolio::find($id);
        $porto->delete();
        return redirect()->back();
    }

    public function view($id)
    {
        $data = Product::find($id);
        $game = Game::all();

        return view('admin.product.edit', compact('data', 'game'));
    }

    public function storeEdit(Request $request, $id)
    {
        $data = Product::find($id);

        $data->update([
            'game_id' => $request->game_id,
            'productName' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);


        if ($request->file('image')) {
            foreach ($request->file('image') as $key) {
                $path = Storage::disk('public')->putFile('product', $key);

                $data->image()->create([
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('product-index')->with('success', 'success change product');
    }

    public function delete($id)
    {
        $data = Product::find(Crypt::decrypt($id));

        $data->delete();

        return redirect()->back();
    }
}
