<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\Eloquent\FurnitureRepository;
use App\Repository\Eloquent\MailChangeRequestRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\FurnitureRepositoryInterface;
use App\Repository\MailChangeRequestRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(
            MailChangeRequestRepositoryInterface::class,
            MailChangeRequestRepository::class
        );
        $this->app->bind(FurnitureRepositoryInterface::class, FurnitureRepository::class);
    }
}
