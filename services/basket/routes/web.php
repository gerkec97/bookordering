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

$app->post('basket/{username}', [
    'as' => 'basket.create-for-user',
    'uses' => 'BasketController@createForUser'
]);

$app->get('basket/{basketId}', ['as' => 'basket.get', 'uses' => 'BasketController@get']);
$app->put('basket/{basketId}', ['as'=>'basket.add-item', 'uses' => 'BasketController@addItem']);
$app->delete('basket/{basketId}', ['as'=>'basket.delete', 'uses' => 'BasketController@delete']);
$app->delete('basket/{basketId}/{isbn13}', ['as'=>'basket.remove-item', 'uses' => 'BasketController@removeItem']);
$app->put('basket/{basketId}/checkout', ['as' => 'basket.checkout', 'uses' => 'BasketController@checkout']);