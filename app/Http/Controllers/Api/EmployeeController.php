<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use Image;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::latest()->get();
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees',
            'phone' => 'required|numeric',
            'address' => 'required',
            'salary' => 'required|numeric',
            'joining_date' => 'required',
            'nid' => 'required|numeric',
        ]);

        if ($request->photo) {
            
            $request->photo;
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->photo)->resize(240,240)->save('backend/employee/'.$img_name);
            $img_url = 'backend/employee/'.$img_name;

            Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'nid' => $request->nid,
                'photo' => $img_url,
                'created_at' => Carbon::now(),
            ]);

        }else{

            Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'nid' => $request->nid,
                'created_at' => Carbon::now(),
            ]);

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
        $employee = Employee::findOrFail($id);
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
        $image = $request->newphoto;
        if ($image) {
            $img = Employee::findOrFail($id);
            $old_imgPath = $img->photo;
            unlink($old_imgPath);

            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->newphoto)->resize(240,240)->save('backend/employee/'.$img_name);
            $img_url = 'backend/employee/'.$img_name;
            Employee::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'nid' => $request->nid,
                'photo' => $img_url,
                'created_at' => Carbon::now(),
            ]);
           
        }else{
            $old_img = $request->photo;
            Employee::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'nid' => $request->nid,
                'photo' => $old_img,
                'created_at' => Carbon::now(),
                
            ]);
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
        $employee = Employee::findOrFail($id);
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
            Employee::findOrFail($id)->delete();           
        }else{
            Employee::findOrFail($id)->delete();
        }

    }
}
