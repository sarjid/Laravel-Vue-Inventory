<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Customer;
use Image;
class CustomerController extends Controller
{
    // store customer 
    public function customerStore(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:suppliers',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        if ($request->photo) {
            
            $request->photo;
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->photo)->resize(240,240)->save('backend/customer/'.$img_name);
            $img_url = 'backend/customer/'.$img_name;

            Customer::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $img_url,
                'created_at' => Carbon::now(),
            ]);
            return response()->json('successfully added customer');
        }else{

            Customer::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'created_at' => Carbon::now(),
            ]);

            return response()->json('successfully added customer');
        } 
        
        
    }

    // ------------------- all customer ----------------------- 
    public function getAll(){
        $customers = Customer::latest()->get();
        return response()->json($customers);
    }

    // ======================== destroy =================== 
    public function destroy($id){
        $Customer = Customer::findOrFail($id);
        $photo = $Customer->photo;
        if ($photo) {
            unlink($photo);
            Customer::findOrFail($id)->delete();           
        }else{
            Customer::findOrFail($id)->delete();
        }
    } 


    // -------------------- edit customer --------------------- 
    public function edit($id){
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    // ------------------------ update customer data -------------------------- 
    public function customerUpdate(Request $request,$id){

        $image = $request->newphoto;
        if ($image) {
            $img = Customer::findOrFail($id);
            $old_imgPath = $img->photo;
            unlink($old_imgPath);

            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->newphoto)->resize(240,240)->save('backend/customer/'.$img_name);
            $img_url = 'backend/customer/'.$img_name;
            Customer::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $img_url,
                'created_at' => Carbon::now(),
            ]);
           
        }else{
            $old_img = $request->photo;
            Customer::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $old_img,
                'created_at' => Carbon::now(),
                
            ]);
        }
    }
}
