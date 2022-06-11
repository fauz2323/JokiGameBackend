<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class OrderAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Order::with('product')->get();

            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="order-detail/' . Crypt::encrypt($row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Detail</a> ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.order.index');
    }

    public function detail($id)
    {
        $order = Order::find(Crypt::decrypt($id));

        return view('admin.order.detail', compact('order'));
    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        if ($request->status == 'dibatalkan' && $order->status != 'selesai' && $order->status != 'dibatalkan') {
            $order->user->balance->balance = $order->user->balance->balance + $order->price;
            $order->user->balance->save();
        }

        return redirect()->back();
    }
}
