<?php

namespace GkBasket\Infrastructure\Persistence\Doctrine\Repositories\Domain;

use GkBasket\Domain\Domain\Repositories\BasketRepositoryInterface;
use GkBasket\Infrastructure\Persistence\Doctrine\Repositories\AbstractRepository;

class BasketRepository extends AbstractRepository implements BasketRepositoryInterface
{
    //
    protected $acceptedFilters = [ 'basketId' => 'e.uuid' ];

}