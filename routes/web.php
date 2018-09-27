<?php

$router->group(['prefix'=>'nxtharvest'], function() use($router){

	$router->get('/orders', 'OrderController@index');
	
	$router->get('/orders/{id}', 'OrderController@show');
	
	$router->post('/orders', 'OrderController@store');
	
	$router->put('/orders/{id}', 'OrderController@update');
	
	$router->delete('/orders/{id}', 'OrderController@destroy');

});

// $router->group(['prefix'=>'nxtharvest'], function() use($router){

// 	$router->get('/products', 'ProductController@index');
	
// 	$router->get('/products/{id}', 'ProductController@show');
	
// 	$router->post('/products', 'ProductController@store');
	
// 	$router->put('/products/{id}', 'ProductController@update');
	
// 	$router->delete('/products/{id}', 'ProductController@destroy');
// });

$router->get('/orders/count', 'OrderController@count');

$router->get('/customers/', 'CustomerController@index');

$router->get('/post/{id}', ['middleware' => 'auth', function (Request $request, $id) {
    $user = Auth::user();

    $user = $request->user();

    //
}]);