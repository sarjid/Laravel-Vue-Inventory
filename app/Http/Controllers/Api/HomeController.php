<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Expense;
use App\Customer;
use App\Employee;
use App\Product;
use Carbon\Carbon;
class HomeController extends Controller
{
    // todays sell 
    public function todaySell(){
        $sell = Order::where('order_date',Carbon::now()->format('d F Y'))->sum('total');
        return response()->json($sell);
    }

    // todays income 
    public function todayIncome(){
        $sell = Order::where('order_date',Carbon::now()->format('d F Y'))->sum('pay');
        return response()->json($sell);
    }

     // todays todayDue 
     public function todayDue(){
        $sell = Order::where('order_date',Carbon::now()->format('d F Y'))->sum('due');
        return response()->json($sell);
    }

     // todays todayExpense 
     public function todayExpense(){
        $sell = Expense::where('date',Carbon::now()->format('d F Y'))->sum('amount');
        return response()->json($sell);
    }

     // todays totalCustomer 
     public function totalCustomer(){
        $sell = count(Customer::all());
        return response()->json($sell);
    }

     // todays totalEmployee 
     public function totalEmployee(){
        $sell = count(Employee::all());
        return response()->json($sell);
    }

     // todays income 
     public function totalProduct(){
        $sell = count(Product::all());
        return response()->json($sell);
    }

     // todays income 
     public function totalStockout(){
        $sell = count(Product::where('product_quantity','<','1')->get());
        return response()->json($sell);
    }
    
  
}
