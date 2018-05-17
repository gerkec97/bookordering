<?php

namespace GkOrder\Domain\Domain\Services;

use GkOrder\Domain\Domain\Entities\Order;
use GkOrder\Domain\Domain\Exceptions\OrderNotFoundException;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Query;

interface OrderServiceInterface
{
    /**
     * @return Order
     */
    public function createOrder(): Order;

    /**
     * @param int $id
     * @return Order
     * @throws OrderNotFoundException
     */
    public function getOrder(int $id): Order;

    /**
     * @param Query $query
     * @return array
     */
    public function getOrders(Query $query): array;

    /**
     * @param Query $query
     * @return PaginatorInterface
     */
    public function getOrdersPaginated(Query $query): PaginatorInterface;

    /**
     * @param int $id
     * @param array $data
     * @return Order
     */
    public function updateOrder(int $id, array $data): Order;

    /**
     * @param int $id
     * @return void
     */
    public function deleteOrder(int $id);
}