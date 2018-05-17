<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GkOrder\Domain\Core\Hydrator\HydratorInterface;
use GkOrder\Infrastructure\Hydrator\Hydrator;
use GkOrder\Domain\Domain\Repositories\OrderRepositoryInterface;
use GkOrder\Infrastructure\Persistence\Doctrine\Repositories\Domain\OrderRepository;
use GkOrder\Domain\Domain\Services\OrderServiceInterface;
use GkOrder\Domain\Domain\Services\OrderService;
use GkOrder\Domain\Domain\Entities\Order;

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

        $this->app->bind(OrderRepositoryInterface::class, function ($app) {
            return new OrderRepository(
                $app['em'],
                $app['em']->getClassMetaData(Order::class)
            );
        });
        
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }
}
