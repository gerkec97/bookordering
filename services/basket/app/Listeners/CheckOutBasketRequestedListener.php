<?php

namespace App\Listeners;

use App\Events\CheckOutBasketRequestedEvent;
use GkBasket\Domain\Domain\Services\BasketServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckOutBasketRequestedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(CheckOutBasketRequestedEvent $event)
    {
//        try {

            $basket = app(BasketServiceInterface::class)->getByBasketUuid($event->getBasketUuid());

            $client = new Client();
            $response = $client->post('http://lggkorder.test/order/create', [
                'json' => [
                    'basket' => [
                        'username' => $basket->getUsername(),
                        'items' => \json_decode($basket->getItems(), true)
                    ]
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                //app(BasketServiceInterface::class)->deleteBasket($basketUuid);
            }
            /*}catch (\Exception $ex) {
               // log failed and return message
           }*/
    }
}
