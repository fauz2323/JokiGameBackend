<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\UserJoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class MessageAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = UserJoki::all();

            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="view-message/' . Crypt::encrypt($row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">View Message</a>';
                    return $btn;
                })
                ->addColumn('unread', function ($data) {
                    $unreadMessage = $data->message()->where('status', 'unread')->count();
                    return $unreadMessage;
                })
                ->rawColumns(['action', 'unread'])
                ->make(true);
        }
        return view('admin.message.index');
    }

    public function viewMessage($id)
    {
        $message = Message::where('user_id', Crypt::decrypt($id))->get();

        return view();
    }

    public function reply(Request $request, $id)
    {
        $reply = Message::create([
            'user_id' => $id,
            'from' => 'admin',
            'message' => $request->message,
            'status' => 'read'
        ]);

        return redirect()->back();
    }
}
