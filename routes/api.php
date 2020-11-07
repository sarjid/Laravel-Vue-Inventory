<?php

use Illuminate\Routing\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');
// salary 
Route::post('/salary/paid/{employee_id}','Api\SalaryController@paid');
Route::get('/salary','Api\SalaryController@allSalary');
Route::get('/salary/view/{month}','Api\SalaryController@salaryView');
Route::get('/salary/edit/{salary_id}','Api\SalaryController@salaryEdit');
Route::post('/salary/update/{salary_id}','Api\SalaryController@salaryUpdate');
// product stock 
Route::post('/stock/update/{product_id}','Api\StockController@stockUpdate');
// customer 
Route::post('/customer/store','Api\CustomerController@customerStore');
Route::get('/customer/all','Api\CustomerController@getAll');
Route::get('/customer/delete/{id}','Api\CustomerController@destroy');
Route::get('/customer/edit/{id}','Api\CustomerController@edit');
Route::post('/customer/update/{id}','Api\CustomerController@customerUpdate');

// pos 
Route::get('/getting/category/product/{cat_id}','Api\PosController@categoryProduct');
// cart 
Route::post('/addToCart/{pro_id}','Api\CartController@addToCart');
Route::get('/getCartProduct','Api\CartController@getAll');
Route::get('/cart/remove/{cart_id}','Api\CartController@removeItem');
Route::get('/cart/increment/{cart_id}','Api\CartController@incrementItem');
Route::get('/cart/decrement/{cart_id}','Api\CartController@decrementItem');
// vat 
Route::get('/vat','Api\CartController@getVat');
// order submit 
Route::post('/orderdone','Api\PosController@orderDone');
// order 
Route::get('/today/all-order','Api\OrderController@todayOrderAll');
Route::get('/order/details/{order_id}','Api\OrderController@orderDetails');
Route::get('/order/details/product/{order_id}','Api\OrderController@orderDetailsProduct');
Route::get('/order/all-orders','Api\OrderController@allOrder');
Route::post('/order/search/date','Api\OrderController@searchDate');
Route::post('/order/search/month','Api\OrderController@searchMonth');
Route::post('/order/search/year','Api\OrderController@searchYear');
// get data in home component 
Route::get('/today/sell','Api\HomeController@todaySell');
Route::get('/today/income','Api\HomeController@todayIncome');
Route::get('/today/due','Api\HomeController@todayDue');
Route::get('/today/expense','Api\HomeController@todayExpense');
Route::get('/total/customer','Api\HomeController@totalCustomer');
Route::get('/total/employee','Api\HomeController@totalEmployee');
Route::get('/total/product','Api\HomeController@totalProduct');
Route::get('/total/stockout/product','Api\HomeController@totalStockout');
