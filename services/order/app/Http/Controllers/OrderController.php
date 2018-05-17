<?php

namespace App\Http\Controllers;

use GkOrder\Domain\Domain\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
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

    public function create(Request $request)
    {
        try {
            $basket = $request->json()->all();

            $order = app(OrderServiceInterface::class)->createOrderFromBasket($basket['basket']);

            $total = array_sum(array_map(function($el) { return $el->getQuantity() * $el->getPrice(); }, $order));

            return response()->json(['items' => count($order), 'total_value' => $total]);
        } catch (\Exception $ex) {
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function listByUser(Request $request, $username) {
        try {
            $orderList = array_map(function($el) {
                return [
                    'order_number' => $el->getOrderNumber(),
                    'isbn13' => $el->getIsbn13(),
                    'quantity' => $el->getQuantity(),
                    'price' => $el->getPrice()
                ];
            }, app(OrderServiceInterface::class)->getListForUsername($username));

            $orderListByOrderNumber = [];
            foreach ($orderList as $item) {
                $orderNumber = $item['order_number'];
                unset ($item['order_number']);
                $orderListByOrderNumber[$orderNumber][] = $item;
            }

            return response()->json($orderListByOrderNumber);
        } catch (\Exception $ex) {
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }
}
