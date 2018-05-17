<?php

namespace App\Http\Controllers;

use GkBasket\Domain\Domain\Exceptions\BasketNotFoundException;
use GkBasket\Domain\Domain\Services\BasketServiceInterface;
use Illuminate\Http\Request;
use GkBasket\Domain\Domain\Entities\Basket;

class BasketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createForUser(Request $request, $username)
    {
        try {
            $basket = app(BasketServiceInterface::class)->createForUser($username);
            return response()->json($this->toJson($basket));
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>[$ex->getMessage() . ' Error while processing request']], 500);
        }
    }

    public function get(Request $request, $basketId) {
        try {
            $basket = app(BasketServiceInterface::class)->getByBasketUuid($basketId);
            return response()->json($this->toJson($basket));
        } catch (BasketNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function addItem(Request $request, $basketId) {

        try {
            $basket = app(BasketServiceInterface::class)->addItemToBasket(
                $basketId,
                $request->json()->get('isbn13'),
                $request->json()->get('quantity')
            );

            return response()->json($this->toJson($basket));
        } catch (BasketNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function delete(Request $request, $basketId)
    {
        try {
            app(BasketServiceInterface::class)->deleteBasket($basketId);
            return response(null,204);
        } catch (BasketNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function removeItem(Request $request, $basketId, $productId)
    {
        try {
            $basket = app(BasketServiceInterface::class)->removeItem($basketId, $productId);
            return response()->json($this->toJson($basket));
        } catch (BasketNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function checkout(Request $request, $basketId)
    {
        try {
            $basket = app(BasketServiceInterface::class)->checkout($basketId);
            // dispatch checkout command
            return response(null,204);
        } catch (BasketNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>[$ex->getMessage()  . ' Error while processing request']], 500);
        }
    }

    private function toJson(Basket $basket)
    {
        return [
            'username' => $basket->getUsername(),
            'items' => json_decode($basket->getItems()),
            'basket_id' => $basket->getUuid()
        ];
    }

    //
}
