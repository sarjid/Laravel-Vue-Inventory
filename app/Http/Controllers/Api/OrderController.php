<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Orderdetails;
use DateTime;
class OrderController extends Controller
{
   public function todayOrderAll(){
        $orders = Order::with('customer')->where('order_date',Carbon::now()->format('d F Y'))->latest()->get();
        return response()->json($orders);
   }

//    get order details 
   public function orderDetails($order_id){
        $details = Order::with('customer')->where('id',$order_id)->first();
        return response()->json($details);
   }

//    product get in order details 
   public function orderDetailsProduct($order_id){
     
       $data = Orderdetails::with('product')->where('order_id',$order_id)->latest()->get();
       return response()->json($data);

   }

   // get all orders 
   public function allOrder(){
      $orders = Order::with('customer')->latest()->get();
        return response()->json($orders);
   }

   // search order by date 
   public function searchDate(Request $request){
      
     $date = $request->order_date;
      $newdate = new DateTime($date);
      $get_date = $newdate->format('d F Y');
      $result = Order::with('customer')->where('order_date',$get_date)->latest()->get();
      return response()->json($result);

   }

   // search order by month 
   public function searchMonth(Request $request){
      $result = Order::with('customer')->where('order_month',$request->order_month)->where('order_year',$request->order_year)->latest()->get();
      return response()->json($result);

   }

   // search order by year 
   public function searchYear(Request $request){
      $result = Order::with('customer')->where('order_year',$request->search_year)->latest()->get();
      return response()->json($result);

   }
}
