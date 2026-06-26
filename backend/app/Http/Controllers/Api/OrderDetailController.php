<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Http\Resources\OrderResource;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,string $id)
    {
        //
        $orders = Order::with(['order_details.product'])
        ->where('id',$id)
        // ->where('id',$request->user()->id)
        ->get();
        // $orders= Order::with([
        //     'user',
        //     'order_details.product'
        // ])
        // ->where('user_id',Auth::id())
        // ->latest()
        // ->get();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
