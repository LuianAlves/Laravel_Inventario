<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Pos;
use DB;
use DateTime;
use App\Models\Expense;

class PosController extends Controller
{
    public function getProduct($id) {
        $product = Product::where('category_id', $id)->get();
        return response()->json($product);
    }

    public function orderDone(Request $request) {
        // $validateData = $request ([]);

        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['quantity'] = $request->quantity;
        $data['sub_total'] = $request->subtotal;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['payby'] = $request->payby;
        $data['order_date'] = date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $order_id = Orders::insertGetId($data);

        $contents = Pos::get();

        $order_data = array();
            foreach($contents as $content) {
                $order_data['order_id'] = $order_id;
                $order_data['product_id'] = $content->pro_id;
                $order_data['pro_quantity'] = $content->pro_quantity;
                $order_data['product_price'] = $content->product_price;
                $order_data['sub_total'] = $content->sub_total;

                OrderDetails::insert($order_data);

                    //Diminuindo a quantidade em estoque após a compra
                    Product::where('id', $content->pro_id)->update(['product_quantity' => DB::raw('product_quantity -' .$content->pro_quantity )]);
            }

        DB::table('pos')->delete();

        return response('Done');

    }

    // Search orders Data
    public function searchOrder(Request $request) {
        $order_date = $request->date;
        $newdate = new DateTime($order_date);

        $done = $newdate->format('d/m/Y');

        $order = Orders::join('customers', 'orders.customer_id', 'customers.id')
                       ->select('customers.name', 'orders.*')
                       ->where('orders.order_date', $done)
                       ->get();


        return response()->json($order);
    }

    // Admin Dashboard -----------------------------
        // All sell
        public function allSell() {
            $sell = Orders::sum('total');

            $total = round($sell, 2);

            return response()->json($total);
        }

        //today sell
        public function todaySell() {
            $date = date('d/m/Y');

            $sell = Orders::where('order_date', $date)
                        ->sum('total');

            $today = round($sell, 2);

            return response()->json($today);
        }

        // Due today
        public function incomeDue() {
            $date = date('d/m/Y');

            $tdue = Orders::where('order_date', $date)
                          ->sum('due');

            $todaydue = round($tdue, 2);

            return response()->json($todaydue);
        }
        //today income (pay)
        public function todayIncome() {
            $date = date('d/m/Y');

            $sell = Orders::where('order_date', $date)
                        ->sum('pay');

            return response()->json($sell);
        }

        // due
        public function todayDue() {
            $due = Orders::sum('due');

            return response()->json($due);
        }

        //today expense
        public function todayExpense() {
            $expense = Expense::sum('amount');

            return response()->json($expense);
        }

        // -------------
        // Due list
        public function duelist() {
            $due = Orders::join('customers', 'orders.customer_id', 'customers.id')
                         ->select('customers.name', 'customers.phone', 'orders.*')
                         ->where('due', '>=', '1')
                         ->orderBy('customers.name', 'ASC')
                         ->get();

            return response()->json($due);
        }
        // Stock Out
        public function StockOut() {
            $product = Product::where('product_quantity', '<', '1')
                              ->orderBy('product_code', 'ASC')
                              ->get();
            return response()->json($product);
        }
}
