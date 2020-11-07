<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Product;
use App\Setting;
use App\Pos;
class CartController extends Controller
{
//    added to cart 
    public function addToCart($pro_id){
        $product = Product::findOrFail($pro_id);
        $check_exist = Pos::where('pro_id',$pro_id)->first();
        if ($check_exist) {
           $increment = Pos::where('pro_id',$pro_id)->increment('pro_quantity');
           $product = Pos::where('pro_id',$pro_id)->first();
           $subtotal = $product->pro_quantity * $product->pro_price;
           Pos::where('pro_id',$pro_id)->update(['sub_total' => $subtotal]);
        }else{
            $insert =  Pos::insert([
                'pro_id' => $pro_id,
                'pro_name' => $product->product_name,
                'pro_quantity' => 1,
                'pro_price' => $product->selling_price,
                'sub_total' => $product->selling_price,
                'created_at' => Carbon::now(),            
            ]);
    
            return response()->json($insert);
        }
      
    }


    // get all cart data 
    public function getAll(){
       $data = Pos::latest()->get();

       return response()->json($data);
    }

    // remove cart item 
    public function removeItem($cart_id){
       $delete =Pos::findOrFail($cart_id)->delete();
       return response()->json('cart remove successfully');
    }

    // increment cart items 
    public function incrementItem($cart_id){
        Pos::findOrFail($cart_id)->increment('pro_quantity');
        $product = Pos::findOrFail($cart_id);
        $subtotal = $product->pro_quantity * $product->pro_price;
        Pos::findOrFail($cart_id)->update(['sub_total' => $subtotal]);
    }

     // decrement cart items 
     public function decrementItem($cart_id){
        Pos::findOrFail($cart_id)->decrement('pro_quantity');
        $product = Pos::findOrFail($cart_id);
        $subtotal = $product->pro_quantity * $product->pro_price;
        Pos::findOrFail($cart_id)->update(['sub_total' => $subtotal]);
    }


    // vat 
    public function getVat(){
      $setting =   Setting::findOrFail(1)->first();
        return response()->json($setting);
    }
    
}
