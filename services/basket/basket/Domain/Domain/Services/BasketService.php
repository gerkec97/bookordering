<?php

namespace GkBasket\Domain\Domain\Services;

use App\Events\CheckOutBasketRequestedEvent;
use GkBasket\Domain\Domain\Entities\Basket;
use GkBasket\Domain\Domain\Exceptions\BasketNotFoundException;
use GkBasket\Domain\Domain\Repositories\BasketRepositoryInterface;
use GkBasket\Domain\Core\Hydrator\HydratorInterface;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Query;
use Assert\Assert;
use Illuminate\Support\Facades\Event;

class BasketService implements BasketServiceInterface
{
    /** @var BasketRepositoryInterface */
    protected $basketRepository;

    /** @var HydratorInterface */
    protected $hydrator;

    /**
     * @param BasketRepositoryInterface $basketRepository
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        BasketRepositoryInterface $basketRepository,
        HydratorInterface $hydrator
    )
    {
        $this->basketRepository = $basketRepository;
        $this->hydrator = $hydrator;
    }

    /**
     * @inheritdoc
     */
    public function getBasket(int $id): Basket
    {
        $basket = $this->basketRepository->findOne($id);

        if (! $basket) {
            throw BasketNotFoundException::byId($id);
        }

        return $basket;
    }

    /**
     * @inheritdoc
     */
    public function getBaskets(Query $query): array
    {
        return $this->basketRepository->findAllByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function getBasketsPaginated(Query $query): PaginatorInterface
    {
        return $this->basketRepository->findPaginatedByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function createBasket(): Basket
    {
        $basket = new Basket();

        return $this->basketRepository->save($basket);
    }

    /**
     * @inheritdoc
     */
    public function updateBasket(int $id, array $data): Basket
    {
        $basket = $this->getBasket($id);

        Assert::lazy()
            ->that($data['username'],'username' )->string()
            ->that($data['items'], 'items')->nullOr()->isJsonString()
            ->that($data['uuid'], 'uuid')->string()
            ->verifyNow();

        $this->hydrator->hydrate($basket, $data);

        return $this->basketRepository->save($basket);
    }

    /**
     * @inheritdoc
     */
    public function deleteBasket(string $basketUuid)
    {
        $basket = $this->getByBasketUuid($basketUuid);
        $this->basketRepository->remove($basket);
    }

    public function createForUser($username) {
        $basket = new Basket();
        $basket->setUsername($username);
        return $this->basketRepository->save($basket);
    }

    public function addItemToBasket($basketUuid, $isbn13, $quantity) {

        Assert::lazy()
            ->that($isbn13, 'isbn13')->string()
            ->that($quantity, 'quantity')->integer()
            ->verifyNow();

        $basket = $this->getByBasketUuid($basketUuid);

        $items = json_decode($basket->getItems(),true);
        $items[$isbn13] = $quantity;

        return $this->updateBasket($basket->getId(), [
            'username' => $basket->getUsername(),
            'items' => json_encode($items),
            'uuid' => $basket->getUuid()
        ]);
    }

    /**
     * @param $basketUuid
     * @param $isbn13
     * @return Basket
     */
    public function removeItem($basketUuid, $isbn13)
    {
        Assert::lazy()->that($isbn13, 'isbn13')->string()->verifyNow();

        $basket = $this->getByBasketUuid($basketUuid);
        $items = json_decode($basket->getItems(),true);

        unset($items[$isbn13]);

        return $this->updateBasket($basket->getId(), [
            'username' => $basket->getUsername(),
            'items' => json_encode($items),
            'uuid' => $basket->getUuid()
        ]);
    }

    public function checkout($basketUuid)
    {
        $basket = $this->getByBasketUuid($basketUuid);

        Event::dispatch(new CheckOutBasketRequestedEvent($basket->getUuid()));
    }


    public function getByBasketUuid($basketUuid)
    {
        $query = Query::createFromFilters([new Equals('basketId', $basketUuid)]);
        $basket = $this->basketRepository->findOneByQuery($query);

        if (!$basket) {
            throw BasketNotFoundException::byBasketUuid($basketUuid);
        }

        return $basket;
    }
}