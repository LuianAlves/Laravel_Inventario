<?php


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

// Views
    //Employee
    Route::apiResource('/employee', 'Api\EmployeeController');
    //Supplier
    Route::apiResource('/supplier', 'Api\SupplierController');
    // Category
    Route::apiResource('/category', 'Api\CategoryController');
    // Product
    Route::apiResource('/product', 'Api\ProductController');
    // Expense
    Route::apiResource('/expense', 'Api\ExpenseController');
    // Customer
    Route::apiResource('/customer', 'Api\CustomerController');

    // Salary
    Route::post('/salary/paid/{id}', 'Api\SalaryController@Paid');
    Route::get('/salary', 'Api\SalaryController@allSalary');             // index
    Route::get('/salary/view/{id}', 'Api\SalaryController@viewSalary');  // show
    Route::get('/edit/salary/{id}', 'Api\SalaryController@editSalary');  // edit
    Route::post('/salary/update/{id}', 'Api\SalaryController@updateSalary'); // update
    
    // Product Stock
    Route::post('/stock/update/{id}', 'Api\ProductController@updateStock'); // update
    
    // POS - GETTING PRODUCTS
    Route::post('/getting/product/{id}', 'Api\PosController@getProduct'); 

    // CART - 
        //ADD TO CART
        Route::get('/addCart/{id}', 'Api\CartController@addCart'); 
        // Product on Cart
        Route::get('/cart/product', 'Api\CartController@productCart'); 
        // Remove on Cart
        Route::get('/remove/cart/{id}', 'Api\CartController@removeCart'); 
        // Increment/Decrement
        Route::get('/increment/{id}', 'Api\CartController@increment'); 
        Route::get('/decrement/{id}', 'Api\CartController@decrement'); 
        
        
    // VAT
    Route::get('/vats', 'Api\CartController@vats'); 
    
    // POS - Order Details
    Route::post('/orderdone', 'Api\PosController@orderDone'); 
    
    // Order 
    Route::get('/orders', 'Api\OrderController@todayOrder'); 
    
    Route::get('/order/details/{id}', 'Api\OrderController@orderDetails'); 
    Route::get('/order/orderdetails/{id}', 'Api\OrderController@orderDetailsAll'); 

    // Order Search
    Route::post('/search/order', 'Api\PosController@searchOrder'); 
    
    
    // -------- Admin Dashboard
        // Cards
        Route::get('/all/sell', 'Api\PosController@allSell'); 
        Route::get('/today/sell', 'Api\PosController@todaySell'); 
        Route::get('/today/income', 'Api\PosController@todayIncome'); 
        Route::get('/income/due', 'Api\PosController@incomeDue'); 
        Route::get('/today/due', 'Api\PosController@todayDue'); 
        Route::get('/today/expense', 'Api\PosController@todayExpense'); 
        // Due list
        Route::get('/due/list', 'Api\PosController@duelist'); 
        Route::get('/stockout', 'Api\PosController@StockOut'); 
