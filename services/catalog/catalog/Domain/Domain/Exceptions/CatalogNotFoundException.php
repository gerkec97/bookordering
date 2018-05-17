<?php

namespace GkCatalog\Domain\Domain\Exceptions;

use GkCatalog\Domain\Core\Exceptions\NotFoundException;

class CatalogNotFoundException extends NotFoundException
{
    /**
     * @param int $id
     * @return CatalogNotFoundException
     */
    public static function byId(int $id)
    {
        return new self(
            sprintf('Catalog with id [%d] not found!', $id)
        );
    }
}