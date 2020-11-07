<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use Image;
use Carbon\Carbon;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::latest()->get();
        return response()->json($supplier);
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
            'email' => 'required|unique:suppliers',
            'phone' => 'required|numeric',
            'address' => 'required',
            'shopname' => 'required',
        ]);

        if ($request->photo) {
            
            $request->photo;
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->photo)->resize(240,240)->save('backend/supplier/'.$img_name);
            $img_url = 'backend/supplier/'.$img_name;

            Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'photo' => $img_url,
                'created_at' => Carbon::now(),
            ]);

        }else{

            Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
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
        $Supplier = Supplier::findOrFail($id);
        return response()->json($Supplier);
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
            $img = Supplier::findOrFail($id);
            $old_imgPath = $img->photo;
            unlink($old_imgPath);

            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->newphoto)->resize(240,240)->save('backend/supplier/'.$img_name);
            $img_url = 'backend/supplier/'.$img_name;
            Supplier::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'photo' => $img_url,
                'created_at' => Carbon::now(),
            ]);
           
        }else{
            $old_img = $request->photo;
            Supplier::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
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
        $Supplier = Supplier::findOrFail($id);
        $photo = $Supplier->photo;
        if ($photo) {
            unlink($photo);
            Supplier::findOrFail($id)->delete();           
        }else{
            Supplier::findOrFail($id)->delete();
        }
    }
}
