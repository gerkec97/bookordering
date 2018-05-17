<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GkCatalog\Domain\Core\Hydrator\HydratorInterface;
use GkCatalog\Infrastructure\Hydrator\Hydrator;
use GkCatalog\Domain\Domain\Repositories\CatalogRepositoryInterface;
use GkCatalog\Infrastructure\Persistence\Doctrine\Repositories\Domain\CatalogRepository;
use GkCatalog\Domain\Domain\Services\CatalogServiceInterface;
use GkCatalog\Domain\Domain\Services\CatalogService;
use GkCatalog\Domain\Domain\Entities\Catalog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HydratorInterface::class, Hydrator::class);

        $this->app->bind(CatalogRepositoryInterface::class, function ($app) {
            return new CatalogRepository(
                $app['em'],
                $app['em']->getClassMetaData(Catalog::class)
            );
        });
        
        $this->app->bind(CatalogServiceInterface::class, CatalogService::class);
    }
}
