<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use Image;

class ProductController extends Controller
{
    
    public function index()
    {
        $product = DB::table('products')
                        ->join('categories', 'products.category_id', 'categories.id')
                        ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                        ->select('categories.category_name', 'suppliers.name', 'products.*')
                        ->orderBy('product_quantity', 'DESC')
                        ->get();

        return response()->json($product);
    }

    public function store(Request $request)
    {
        // $validateData = $request->validate([]);

            if($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];

                $name = time().".".$ext;
                $img = Image::make($request->image)->resize(240, 200);
                $upload_path = 'images/product/';
                $image_url = $upload_path.$name;

                $img->save($image_url);

                $product = new Product();
                    $product->category_id = $request->category_id;
                    $product->product_name = $request->product_name;
                    $product->product_code = $request->product_code;
                    $product->root = $request->root;
                    $product->buying_price = $request->buying_price;
                    $product->selling_price = $request->selling_price;
                    $product->supplier_id = $request->supplier_id;
                    $product->buying_date = $request->buying_date;
                    $product->image = $image_url;
                    $product->product_quantity = $request->product_quantity;
                    $product->save();
                    
            } else {
                $product = new Product();
                    $product->category_id = $request->category_id;
                    $product->product_name = $request->product_name;
                    $product->product_code = $request->product_code;
                    $product->root = $request->root;
                    $product->buying_price = $request->buying_price;
                    $product->selling_price = $request->selling_price;
                    $product->supplier_id = $request->supplier_id;
                    $product->buying_date = $request->buying_date;
                    $product->product_quantity = $request->product_quantity;
                    $product->save();
            }
            
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['root'] = $request->root;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;

        $image = $request->newimage;

            if($image) {
                $position = strpos($image, ';');
                $sub = substr($image, 0, $position);
                $ext = explode('/', $sub)[1];

                $name = time().".".$ext;
                $img = Image::make($image)->resize(240, 200);
                $upload_path = 'images/product/';
                $image_url = $upload_path.$name;

                $success = $img->save($image_url);

                    if($success) {
                        $data['image'] = $image_url;
                        $img = Product::where('id', $id)->first();
                        $image_path = $img->image;
                        $done = unlink($image_path);
                        $user = Product::where('id', $id)->update($data);
                    }
            } else {
                $oldimage = $request->image;
                $data['image'] = $oldimage;
                $user = Product::where('id', $id)->update($data);
            }
    }

    public function destroy($id) {
        $product = Product::where('id', $id)->first();
        $image = $product->image;
            if($image) {
                unlink($image);

                Product::where('id', $id)->delete();
            } else {

                Product::where('id', $id)->delete();
            }
        }

    public function updateStock(Request $request, $id) {
        $data = array();
        $data['product_quantity'] = $request->product_quantity;

        $product = Product::where('id', $id)->update($data);
    }
}
