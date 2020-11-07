<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
class StockController extends Controller
{
    public function stockUpdate(Request $request,$product_id){
        $stock = Product::findOrFail($product_id)->update(['product_quantity' => $request->product_quantity]);
        return response()->json('stock updated successfully');
    }
}
