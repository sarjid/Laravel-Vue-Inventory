<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Pos;
use App\Order;
use App\Orderdetails;
use Carbon\Carbon;
use DB;

class PosController extends Controller
{
    // get category wisse product 
    public function categoryProduct($cat_id){
        $product = Product::where('category_id',$cat_id)->latest()->get();
        return response()->json($product);
    }

    // oder done 
    public function orderDone(Request $request){

        $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
        ]);

        $order_id = Order::insertGetId([
            'customer_id' => $request->customer_id,
            'qty' => $request->qty,
            'sub_total' => $request->subtotal,
            'vat' => $request->vat,
            'total' => $request->total,
            'pay' => $request->pay,
            'due' => $request->due,
            'payby' => $request->payby,
            'order_date' => Carbon::now()->format('d F Y'),
            'search_date' => Carbon::now()->format('Y-m-d'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'created_at' => Carbon::now(),
        ]);

        $contents = Pos::latest()->get();

        foreach ($contents as $content) {
           Orderdetails::insert([
                'order_id' => $order_id,
                'product_id' => $content->pro_id,
                'pro_quantity' => $content->pro_quantity,
                'product_price' => $content->pro_price,
                'sub_total' => $content->sub_total,
                'created_at' => Carbon::now(),
           ]);
        //    product stock decrement 
            // Product::findOrFail($content->pro_id)->update(['product_quantity',DB::raw('product_quantity -' .$content->pro_quantity)]);

            Product::findOrFail($content->pro_id)->decrement('product_quantity',$content->pro_quantity);
        }

        // clear cart 
        Pos::latest()->delete();
        return response()->json('order done');

    }
}
