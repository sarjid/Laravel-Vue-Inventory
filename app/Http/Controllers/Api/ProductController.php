<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Carbon\Carbon;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return response()->json($products);
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
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ],[
            'category_id.required' => 'category filed is required',
            'supplier_id.required' => 'supplier filed is required',
        ]);

        if ($request->image) {
            $request->imageimage;
            $position = strpos($request->image,';');
            $sub = substr($request->image, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->image)->resize(240,200)->save('backend/product/'.$img_name);
            $img_url = 'backend/product/'.$img_name;

            Product::insert([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'buying_date' => $request->buying_date,
                'product_quantity' => $request->product_quantity,
                'image' => $img_url,
                'created_at' => Carbon::now(),
            ]);

        }else{
            Product::insert([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'buying_date' => $request->buying_date,
                'product_quantity' => $request->product_quantity,
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
        $category = Product::findOrFail($id);
        return response()->json($category);
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
            $img = Product::findOrFail($id);
            $old_imgPath = $img->image;
            unlink($old_imgPath);

            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $img_name = time().'.'.$ext;
            Image::make($request->newphoto)->resize(240,240)->save('backend/product/'.$img_name);
            $img_url = 'backend/product/'.$img_name;
            Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'buying_date' => $request->buying_date,
                'product_quantity' => $request->product_quantity,
                'image' => $img_url,
                'created_at' => Carbon::now(),
            ]);
           
        }else{
            $old_img = $request->image;
            Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'buying_date' => $request->buying_date,
                'product_quantity' => $request->product_quantity,
                'image' => $old_img,
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
        $product = Product::findOrFail($id);
        $photo = $product->image;
        if ($photo) {
            unlink($photo);
            Product::findOrFail($id)->delete();           
        }else{
            Product::findOrFail($id)->delete();
        }

    }
}
