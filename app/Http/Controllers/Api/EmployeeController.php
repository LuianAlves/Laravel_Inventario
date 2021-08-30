<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Intervention\Image\ImageManagerStatic as Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();

        return response()->json($employee);
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
                $upload_path = 'images/employee/';
                $image_url = $upload_path.$name;

                $img->save($image_url);

                $employee = new Employee();
                    $employee->name = $request->name;
                    $employee->email = $request->email;
                    $employee->address = $request->address;
                    $employee->phone = $request->phone;
                    $employee->sallery = $request->sallery;
                    $employee->nid = $request->nid;
                    $employee->joining_date = $request->joining_date;
                    $employee->photo = $image_url;
                    $employee->save();  
            } else {

                $employee = new Employee();
                    $employee->name = $request->name;
                    $employee->email = $request->email;
                    $employee->address = $request->address;
                    $employee->phone = $request->phone;
                    $employee->sallery = $request->sallery;
                    $employee->nid = $request->nid;
                    $employee->joining_date = $request->joining_date;
                    $employee->save(); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['sallery'] = $request->sallery;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;

        $image = $request->newphoto;

            if($image) {
                $position = strpos($image, ';');
                $sub = substr($image, 0, $position);
                $ext = explode('/', $sub)[1];

                $name = time().".".$ext;
                $img = Image::make($image)->resize(240, 200);
                $upload_path = 'images/employee/';
                $image_url = $upload_path.$name;

                $success = $img->save($image_url);

                    if($success) {
                        $data['photo'] = $image_url;
                        $img = Employee::where('id', $id)->first();
                        $image_path = $img->photo;
                        $done = unlink($image_path);
                        $user = Employee::where('id', $id)->update($data);
                    }
            } else {
                $oldphoto = $request->photo;
                $data['photo'] = $oldphoto;
                $user = Employee::where('id', $id)->update($data);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        $photo = $employee->photo;
            if($photo) {
                unlink($photo);

                Employee::where('id', $id)->delete();
            } else {
                Employee::where('id', $id)->delete();
            }
    }
}
