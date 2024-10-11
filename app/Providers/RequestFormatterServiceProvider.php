<?php

declare(strict_types=1);

namespace App\Providers;

use App\Formatters\FurnitureRequestFormatter;
use App\Formatters\Interfaces\FurnitureRequestFormatterInterface;
use Illuminate\Support\ServiceProvider;

final class RequestFormatterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            FurnitureRequestFormatterInterface::class,
            FurnitureRequestFormatter::class
        );
    }
}
