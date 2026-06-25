<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\MypageResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $orders= Order::with([
            'user',
            'order_details.product'
        ])
        ->where('user_id',Auth::id())
        ->latest()
        ->get();
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
