<?php

namespace GkOrder\Domain\Domain\Services;

use Carbon\Carbon;
use GkOrder\Domain\Domain\Entities\Order;
use GkOrder\Domain\Domain\Exceptions\OrderNotFoundException;
use GkOrder\Domain\Domain\Repositories\OrderRepositoryInterface;
use GkOrder\Domain\Core\Hydrator\HydratorInterface;
use GuzzleHttp\Client;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Query;
use Ramsey\Uuid\Uuid;

class OrderService implements OrderServiceInterface
{
    /** @var OrderRepositoryInterface */
    protected $orderRepository;

    /** @var HydratorInterface */
    protected $hydrator;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        HydratorInterface $hydrator
    )
    {
        $this->orderRepository = $orderRepository;
        $this->hydrator = $hydrator;
    }

    /**
     * @inheritdoc
     */
    public function getOrder(int $id): Order
    {
        $order = $this->orderRepository->findOne($id);

        if (! $order) {
            throw OrderNotFoundException::byId($id);
        }

        return $order;
    }

    /**
     * @inheritdoc
     */
    public function getOrders(Query $query): array
    {
        return $this->orderRepository->findAllByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function getOrdersPaginated(Query $query): PaginatorInterface
    {
        return $this->orderRepository->findPaginatedByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function createOrder(): Order
    {
        $order = new Order();

        return $this->orderRepository->save($order);
    }

    /**
     * @inheritdoc
     */
    public function updateOrder(int $id, array $data): Order
    {
        $order = $this->getOrder($id);

        $this->hydrator->hydrate($order, $data);

        return $this->orderRepository->save($order);
    }

    /**
     * @inheritdoc
     */
    public function deleteOrder(int $id)
    {
        $order = $this->getOrder($id);
        $this->orderRepository->remove($order);
    }

    public function createOrderFromBasket($basket)
    {
        $orderNumber = Uuid::uuid4();
        $username = $basket['username'];

        // TODO: this should go into a command
        $client = new Client();
        $response = $client->get('http://lggkcatalog.test/catalog/list-books');

        $orderedIsbns = array_keys($basket['items']);

        $orderedBooks = array_filter(json_decode($response->getBody(), true), function($el) use ($orderedIsbns) {
            return in_array($el['isbn'], $orderedIsbns);
        });

        $createdAt = Carbon::now();
        $orderItems = [];

        foreach($orderedBooks as $book) {
            $order = new Order();

            $data = [
                'orderNumber' => $orderNumber,
                'username' => $username,
                'isbn13' => $book['isbn'],
                'quantity' => $basket['items'][$book['isbn']],
                'price' => $book['price']
            ];

            $order->setCreatedAt($createdAt);
            $order->setUpdatedAt($createdAt);

            $this->hydrator->hydrate($order, $data);

            $orderItems[] = $this->orderRepository->save($order);
        }

        return $orderItems;
    }

    public function getListForUsername($username)
    {
        $query = Query::createFromFilters([new Equals('username', $username)]);
        return $this->getOrders($query);
    }
}