<?php

namespace GkBasket\Domain\Domain\Services;

use GkBasket\Domain\Domain\Entities\Basket;
use GkBasket\Domain\Domain\Exceptions\BasketNotFoundException;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Query;

interface BasketServiceInterface
{
    /**
     * @return Basket
     */
    public function createBasket(): Basket;

    /**
     * @param int $id
     * @return Basket
     * @throws BasketNotFoundException
     */
    public function getBasket(int $id): Basket;

    /**
     * @param Query $query
     * @return array
     */
    public function getBaskets(Query $query): array;

    /**
     * @param Query $query
     * @return PaginatorInterface
     */
    public function getBasketsPaginated(Query $query): PaginatorInterface;

    /**
     * @param int $id
     * @param array $data
     * @return Basket
     */
    public function updateBasket(int $id, array $data): Basket;

    /**
     * @param string $basketUuid
     * @return void
     */
    public function deleteBasket(string $basketUuid);

}