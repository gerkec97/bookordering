<?php

namespace GkBasket\Domain\Domain\Exceptions;

use GkBasket\Domain\Core\Exceptions\NotFoundException;

class BasketNotFoundException extends NotFoundException
{
    /**
     * @param int $id
     * @return BasketNotFoundException
     */
    public static function byId(int $id)
    {
        return new self(
            sprintf('Basket with id [%d] not found!', $id)
        );
    }

    /**
     * @param string $uuid
     * @return BasketNotFoundException
     */
    public static function byBasketUuid(string $uuid)
    {
        return new self(
            sprintf('Basket with id [%s] not found!', $uuid)
        );
    }

}