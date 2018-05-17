<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @OAS\Info(
 *     description="This is the web facing end of the bookstore. The magic though happens behind closed doors",
 *     version="0.9",
 *     @OAS\Contact(
 *      email="thiswontbeme@example.com"
 *     ),
 *     title="The Book Emporium"
 * )
 * @OAS\Tag(
 *     name="user",
 *     description="The shop user"
 * )
 * @OAS\Tag(
 *     name="basket",
 *     description="A shopping basket"
 * )
 * @OAS\Tag(
 *     name="catalog",
 *     description="List our books"
 * )
 */

/**
 * @OAS\Get(
 *     path="/user/{username}",
 *     tags={"user"},
 *     summary="Get user by user name",
 *     operationId="get",
 *     @OAS\Parameter(
 *         name="username",
 *         in="path",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=200,
 *         description="successful operation",
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/User"
 *             )
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid username supplied"
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="User not found"
 *     ),
 * )
 */
Route::get('/user/{username}', 'UserController@get')->name('get-user');


/**
 * @OAS\Get(
 *     path="/user/{username}/purchase-history",
 *     tags={"user"},
 *     summary="Get purchase history for a user by user name",
 *     operationId="get",
 *     @OAS\Parameter(
 *         name="username",
 *         in="path",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=200,
 *         description="successful operation",
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/UserPurchaseHistory"
 *             )
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid username supplied"
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="User not found"
 *     ),
 * )
 */
Route::get('/user/{username}/purchase-history', 'UserController@purchaseHistory')->name('purchase-history');

/**
 * @OAS\Post(
 *     path="/user",
 *     tags={"user"},
 *     summary="Create user",
 *     description="This can only be done by the logged in user.",
 *     operationId="createUser",
 *     @OAS\Response(
 *         response="default",
 *         description="successful operation"
 *     ),
 *     @OAS\RequestBody(
 *         description="Create user object",
 *         required=true,
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/User"
 *             )
 *         )
 *     )
 * )
 */
Route::post('/user', 'UserController@register')->name('register-user');

/**
 * @OAS\Put(
 *     path="/user/{username}",
 *     summary="Updated user",
 *     operationId="update",
 *     tags={"user"},
 *     @OAS\Parameter(
 *         name="username",
 *         in="path",
 *         description="name that to be updated",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid user supplied"
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="User not found"
 *     ),
 *     @OAS\RequestBody(
 *         description="Updated user object",
 *         required=true,
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/User"
 *             )
 *         )
 *     )
 * )
 */
Route::put('/user/{username}', 'UserController@update')->name('update-user');

/**
 * @OAS\Delete(
 *     path="/user/{username}",
 *     tags={"user"},
 *     summary="Delete user",
 *     operationId="unregister",
 *     @OAS\Parameter(
 *         name="username",
 *         in="path",
 *         description="The name that needs to be deleted",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid username supplied",
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="User not found",
 *     )
 * )
 */
Route::delete('/user/{username}', 'UserController@unregister')->name('unregister-user');

/**
 * @OAS\Get(
 *     path="/basket/{basketId}",
 *     tags={"basket"},
 *     summary="Get a basket by id",
 *     operationId="get",
 *     @OAS\Parameter(
 *         name="basketId",
 *         in="path",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=200,
 *         description="successful operation",
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/Basket"
 *             )
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid basket id supplied"
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="Basket not found"
 *     )
 * )
 */
Route::get('/basket/{basketId}', 'BasketController@get')->name('get-basket');

/**
 * @OAS\Post(
 *     path="/basket",
 *     tags={"basket"},
 *     summary="Create a basket",
 *     operationId="create",
 *     @OAS\Response(
 *         response="default",
 *         description="successful operation"
 *     ),
 *     @OAS\RequestBody(
 *         description="Create basket object",
 *         required=true,
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/User"
 *             )
 *         )
 *     )
 * )
 */
Route::post('/basket', 'BasketController@create')->name('create-basket');

/**
 * @OAS\Put(
 *     path="/basket/{basketId}",
 *     tags={"basket"},
 *     summary="Add item to basket",
 *     operationId="addItem",
 *     @OAS\Parameter(
 *         name="basketId",
 *         in="path",
 *         description="The basket id of the basket that needs to be filled",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid basketId supplied",
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="basket not found",
 *     ),
 *     @OAS\RequestBody(
 *         description="item id that goes into the basket",
 *         required=true,
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/User"
 *             )
 *         )
 *     )
 * )
 */
Route::put('/basket/{basketId?}', 'BasketController@addItem')->name('basket.add-item');

/**
 * @OAS\Put(
 *     path="/basket/{basketId}/checkout",
 *     tags={"basket"},
 *     summary="Checkout the basket",
 *     operationId="checkout",
 *     @OAS\Parameter(
 *         name="basketId",
 *         in="path",
 *         description="The basket id of the basket that will be checked out",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid basketId supplied",
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="basket not found",
 *     )
 * )
 */
Route::post('/basket/{basketId}/checkout', 'BasketController@checkout')->name('checkout-basket');

/**
 * @OAS\Delete(
 *     path="/basket/{basketId}",
 *     tags={"basket"},
 *     summary="Delete basket",
 *     operationId="delete",
 *     @OAS\Parameter(
 *         name="basketId",
 *         in="path",
 *         description="The basket id of the basket that needs to be deleted",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid basketId supplied",
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="basket not found",
 *     )
 * )
 */
Route::delete('/basket/{basketId}', 'BasketController@delete')->name('delete-basket');
/**
 * @OAS\Delete(
 *     path="/basket/{basketId}/{productId}",
 *     tags={"basket"},
 *     summary="Remove an item from the basket",
 *     operationId="removeItem",
 *     @OAS\Parameter(
 *         name="basketId",
 *         in="path",
 *         description="The basket id of the basket containing the item",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Parameter(
 *         name="productId",
 *         in="path",
 *         description="The product id of the item that needs to be removed",
 *         required=true,
 *         @OAS\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid basketId supplied",
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="basket not found",
 *     )
 * )
 */
Route::delete('/basket/{basketId}/{productId}', 'BasketController@removeProduct')->name('remove-product');

/**
 * @OAS\Get(
 *     path="/catalog",
 *     tags={"catalog"},
 *     summary="Get available books",
 *     operationId="showBooks",
 *     @OAS\Response(
 *         response=200,
 *         description="successful operation",
 *         @OAS\MediaType(
 *             mediaType="application/json",
 *             @OAS\Schema(
 *                 ref="#/components/schemas/Books"
 *             )
 *         )
 *     ),
 *     @OAS\Response(
 *         response=404,
 *         description="Catalog not found"
 *     )
 * )
 */
Route::get('/catalog', 'CatalogController@showBooks')->name('show-all-books');
