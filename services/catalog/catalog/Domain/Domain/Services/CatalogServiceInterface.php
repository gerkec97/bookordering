<?php

namespace GkCatalog\Domain\Domain\Services;

use GkCatalog\Domain\Domain\Entities\Catalog;
use GkCatalog\Domain\Domain\Exceptions\CatalogNotFoundException;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Query;

interface CatalogServiceInterface
{
    /**
     * @return Catalog
     */
    public function createCatalog(): Catalog;

    /**
     * @param int $id
     * @return Catalog
     * @throws CatalogNotFoundException
     */
    public function getCatalog(int $id): Catalog;

    /**
     * @param Query $query
     * @return array
     */
    public function getCatalogs(Query $query): array;

    /**
     * @param Query $query
     * @return PaginatorInterface
     */
    public function getCatalogsPaginated(Query $query): PaginatorInterface;

    /**
     * @param int $id
     * @param array $data
     * @return Catalog
     */
    public function updateCatalog(int $id, array $data): Catalog;

    /**
     * @param int $id
     * @return void
     */
    public function deleteCatalog(int $id);
}