<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TopupControllerAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TopUp::with('user')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="topup-detail/' . $row->id . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.topup.index');
    }

    public function view($id)
    {
        $topup = TopUp::find($id);
        return view('admin.topup.view', compact('topup'));
    }

    public function confirm($id)
    {
        $topup = TopUp::find($id);

        if ($topup->status == 'dicek') {
            $topup->user->balance->balance = $topup->user->balance->balance + $topup->total;
            $topup->user->balance->save();
            $topup->status = 'success';
            $topup->save();
        }

        return redirect()->back();
    }
}
