<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Intervention\Image\ImageManagerStatic as Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validateData = $request->validate([]);

            if($request->photo) {
                $position = strpos($request->photo, ';');
                $sub = substr($request->photo, 0, $position);
                $ext = explode('/', $sub)[1];

                $name = time().".".$ext;
                $img = Image::make($request->photo)->resize(240, 200);
                $upload_path = 'images/supplier/';
                $image_url = $upload_path.$name;

                $img->save($image_url);

                $supplier = new Supplier();
                    $supplier->name = $request->name;
                    $supplier->email = $request->email;
                    $supplier->phone = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->shopname = $request->shopname;
                    $supplier->photo = $image_url;
                    $supplier->save();  
            } else {

                $supplier = new Supplier();
                    $supplier->name = $request->name;
                    $supplier->email = $request->email;
                    $supplier->phone = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->shopname = $request->shopname;
                    $supplier->save(); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['shopname'] = $request->shopname;


        $image = $request->newphoto;

            if($image) {
                $position = strpos($image, ';');
                $sub = substr($image, 0, $position);
                $ext = explode('/', $sub)[1];

                $name = time().".".$ext;
                $img = Image::make($image)->resize(240, 200);
                $upload_path = 'images/supplier/';
                $image_url = $upload_path.$name;

                $success = $img->save($image_url);

                    if($success) {
                        $data['photo'] = $image_url;
                        $img = Supplier::where('id', $id)->first();
                        $image_path = $img->photo;
                        $done = unlink($image_path);
                        $user = Supplier::where('id', $id)->update($data);
                    }
            } else {
                $oldphoto = $request->photo;
                $data['photo'] = $oldphoto;
                $user = Supplier::where('id', $id)->update($data);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        $photo = $supplier->photo;
            if($photo) {
                unlink($photo);

                Supplier::where('id', $id)->delete();
            } else {
                Supplier::where('id', $id)->delete();
            }
    }
}
