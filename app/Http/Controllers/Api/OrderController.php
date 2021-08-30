<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    public function todayOrder() {

        $data = date('d/m/Y');
        
        $order = Orders::join('customers', 'orders.customer_id', 'customers.id')
                    ->where('order_date', $data)
                    ->select('customers.name', 'orders.*')
                    ->orderBy('customers.name', 'ASC')
                    ->get();

        return response()->json($order);
    }

    public function orderDetails($id) {
        $order = Orders::join('customers', 'orders.customer_id', 'customers.id')
                        ->where('orders.id', $id)
                        ->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
                        ->first();

        return response()->json($order);
    }

    public function orderDetailsAll($id) {
        $details = OrderDetails::join('products', 'order_details.product_id', 'products.id')
                             ->where('order_details.order_id', $id)
                             ->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
                             ->get();

        return response()->json($details);
    }
}
