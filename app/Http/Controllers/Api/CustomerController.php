<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Image;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::orderBy('name', 'ASC')->get();
        return response()->json($customer);
    }

    public function store(Request $request)
    {
        // $validateData = $request->validate([]);

            if($request->photo) {
                $position = strpos($request->photo, ';');
                $sub = substr($request->photo, 0, $position);
                $ext = explode('/', $sub)[1];

                $name = time().".".$ext;
                $img = Image::make($request->photo)->resize(240, 200);
                $upload_path = 'images/customer/';
                $image_url = $upload_path.$name;

                $img->save($image_url);

                $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->email = $request->email;
                    $customer->phone = $request->phone;
                    $customer->address = $request->address;
                    $customer->photo = $image_url;
                    $customer->save();
            } else {

                $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->email = $request->email;
                    $customer->phone = $request->phone;
                    $customer->address = $request->address;
                    $customer->save();
            }
    }

    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {     
        $data = array();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;

        $image = $request->newphoto;

        if($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'images/customer/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

                if($success) {
                    $data['photo'] = $image_url;
                    $img = Customer::where('id', $id)->first();
                    $image_path = $img->photo;
                    $done = unlink($image_path);
                    $user = Customer::where('id', $id)->update($data);
                }
        } else {
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = Customer::where('id', $id)->update($data);
        }

    }

    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->first();
        $photo = $customer->photo;
            if ($photo) {
                unlink($photo);
                Customer::where('id', $id)->delete();
            } else {
                Customer::where('id', $id)->delete();
            }
    }
}
