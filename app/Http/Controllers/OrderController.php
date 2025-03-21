<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends BaseController
{
    public function list()
    {
        $seller_id = request()->user()->id;

        $orders = Order::whereHas('items.product', function ($query) use ($seller_id) {
            $query->where('seller_id', $seller_id);
        })->with('items')->paginate(10);

        return $this->sendSuccessResponse($orders, 'Orders retrieved successfully!');
    }

    public function show($id)
    {
        $order = Order::with('items')->find($id);

        return $this->sendSuccessResponse($order, 'Order retrieved successfully!');
    }
}
