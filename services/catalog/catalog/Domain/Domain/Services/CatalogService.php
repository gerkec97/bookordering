<?php

namespace GkCatalog\Domain\Domain\Services;

use GkCatalog\Domain\Domain\Entities\Catalog;
use GkCatalog\Domain\Domain\Exceptions\CatalogNotFoundException;
use GkCatalog\Domain\Domain\Repositories\CatalogRepositoryInterface;
use GkCatalog\Domain\Core\Hydrator\HydratorInterface;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Query;

class CatalogService implements CatalogServiceInterface
{
    /** @var CatalogRepositoryInterface */
    protected $catalogRepository;

    /** @var HydratorInterface */
    protected $hydrator;

    /**
     * @param CatalogRepositoryInterface $catalogRepository
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        CatalogRepositoryInterface $catalogRepository,
        HydratorInterface $hydrator
    )
    {
        $this->catalogRepository = $catalogRepository;
        $this->hydrator = $hydrator;
    }

    /**
     * @inheritdoc
     */
    public function getCatalog(int $id): Catalog
    {
        $catalog = $this->catalogRepository->findOne($id);

        if (! $catalog) {
            throw CatalogNotFoundException::byId($id);
        }

        return $catalog;
    }

    /**
     * @inheritdoc
     */
    public function getCatalogs(Query $query): array
    {
        return $this->catalogRepository->findAllByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function getCatalogsPaginated(Query $query): PaginatorInterface
    {
        return $this->catalogRepository->findPaginatedByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function createCatalog(): Catalog
    {
        $catalog = new Catalog();

        return $this->catalogRepository->save($catalog);
    }

    /**
     * @inheritdoc
     */
    public function updateCatalog(int $id, array $data): Catalog
    {
        $catalog = $this->getCatalog($id);

        $this->hydrator->hydrate($catalog, $data);

        return $this->catalogRepository->save($catalog);
    }

    /**
     * @inheritdoc
     */
    public function deleteCatalog(int $id)
    {
        $catalog = $this->getCatalog($id);
        $this->catalogRepository->remove($catalog);
    }

    public function getBooks()
    {
        $books = $this->getCatalogs(new Query());

        return array_map(function(Catalog $el) { return [
            'title' => $el->getTitle(),
            'isbn' => $el->getIsbn(),
            'price' => $el->getPrice()
        ];}, $books);
    }
}