<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GkBasket\Domain\Core\Hydrator\HydratorInterface;
use GkBasket\Infrastructure\Hydrator\Hydrator;
use GkBasket\Domain\Domain\Repositories\BasketRepositoryInterface;
use GkBasket\Infrastructure\Persistence\Doctrine\Repositories\Domain\BasketRepository;
use GkBasket\Domain\Domain\Services\BasketServiceInterface;
use GkBasket\Domain\Domain\Services\BasketService;
use GkBasket\Domain\Domain\Entities\Basket;

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

        $this->app->bind(BasketRepositoryInterface::class, function ($app) {
            return new BasketRepository(
                $app['em'],
                $app['em']->getClassMetaData(Basket::class)
            );
        });
        
        $this->app->bind(BasketServiceInterface::class, BasketService::class);
    }
}
