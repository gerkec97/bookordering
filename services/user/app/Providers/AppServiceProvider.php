<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use EmeraldIsland\Domain\Core\Hydrator\HydratorInterface;
use EmeraldIsland\Infrastructure\Hydrator\Hydrator;
use EmeraldIsland\Domain\Domain\Repositories\UserRepositoryInterface;
use EmeraldIsland\Infrastructure\Persistence\Doctrine\Repositories\Domain\UserRepository;
use EmeraldIsland\Domain\Domain\Services\UserServiceInterface;
use EmeraldIsland\Domain\Domain\Services\UserService;
use EmeraldIsland\Domain\Domain\Entities\User;

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
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}
