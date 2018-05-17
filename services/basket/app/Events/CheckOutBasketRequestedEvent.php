<?php

namespace App\Events;

class CheckOutBasketRequestedEvent extends Event
{

    private $basketUuid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($basketUuid)
    {
        $this->basketUuid = $basketUuid;    //
    }

    public function getBasketUuid()
    {
        return $this->basketUuid;
    }
}
