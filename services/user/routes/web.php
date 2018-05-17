<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('user/{username}', ['as'=>'example.get', 'uses' => 'ExampleController@get']);
$app->post('user', ['as'=>'example.register', 'uses' => 'ExampleController@register']);
$app->delete('user/{username}', ['as'=>'example.unregister', 'uses' => 'ExampleController@unregister']);
$app->put('user/{username}', ['as'=>'example.update', 'uses' => 'ExampleController@update']);
$app->get('user/{username}/orders', ['as' => 'user.orders' , 'uses' => 'ExampleController@listOrders']);