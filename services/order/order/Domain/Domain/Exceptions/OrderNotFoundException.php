<?php

namespace GkOrder\Domain\Domain\Exceptions;

use GkOrder\Domain\Core\Exceptions\NotFoundException;

class OrderNotFoundException extends NotFoundException
{
    /**
     * @param int $id
     * @return OrderNotFoundException
     */
    public static function byId(int $id)
    {
        return new self(
            sprintf('Order with id [%d] not found!', $id)
        );
    }
}