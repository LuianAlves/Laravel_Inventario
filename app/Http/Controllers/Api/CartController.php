<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Extra;
use App\Models\Pos;

class CartController extends Controller
{
    public function addCart(Request $request, $id) {
        $product = Product::where('id', $id)->first();

        $check = Pos::where('pro_id', $id)->first();

        if($product->product_quantity >= 1) {
            if ($check) {
                Pos::where('pro_id', $id)->increment('pro_quantity');
                
                // Increment ao clicar na imagem
                    $product = Pos::where('pro_id', $id)->first();
                    $subtotal = $product->pro_quantity * $product->product_price;
                
                    Pos::where('pro_id', $id)->update(['sub_total' => $subtotal]);
                
            } else {
                $data = array();
    
                $data['pro_id'] = $id;
                $data['pro_name'] = $product->product_name;
                $data['pro_quantity'] = 1;
                $data['product_price'] = $product->selling_price;
                $data['sub_total'] = $product->selling_price;
    
                Pos::insert($data);
            }
        }  else {
            $stock_out = 'Stock Out!';

            return response()->json($stock_out);
        }
    }

    public function productCart() {

        $cart = Pos::get();
        return response()->json($cart);
    }

    // Remover do Carrinho
    public function removeCart($id) {

        Pos::where('id', $id)->delete();
        return response('Done');
    }

    // Increment
    public function increment($id) {
        $quantity = Pos::where('id', $id)->increment('pro_quantity');

        $product = Pos::where('id', $id)->first();
        $subtotal = $product->pro_quantity * $product->product_price;

        Pos::where('id', $id)->update(['sub_total' => $subtotal]);

        return response('Done');
    }
    
    // Decrement
    public function decrement($id) {
        $quantity = Pos::where('id', $id)->decrement('pro_quantity');
    
        $product = Pos::where('id', $id)->first();
        $subtotal = $product->pro_quantity * $product->product_price;
    
        Pos::where('id', $id)->update(['sub_total' => $subtotal]);
    
        return response('Done');
    }

    // Vats
    public function vats() {
        $vat = Extra::first();
        return response()->json($vat);
    }
}
