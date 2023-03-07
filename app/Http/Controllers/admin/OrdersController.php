<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function pendingOrders(){
        $pending = order::where('status','pending')->get();
        return view('admin.orders.pendingOrders',compact('pending'));
    }
    public function confirm(Request $request,$id)
    {
        order::find($id)->update([
            'status'=>$request->status,
        ]);
        return redirect()->route('confirmordershow');

    }
    public function confirmorder()
    {
        $confirm = order::where('status','confirm')->latest()->get();
        return view('admin.orders.confirm',compact('confirm'));
    }

    public function confirmorderremove ($id)
    {
        order::find($id)->delete();
        return back();
    }
}
