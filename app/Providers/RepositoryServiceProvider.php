<?php

namespace App\Providers;

use App\Domain\Inventory\Interfaces\IInventoryRepository;
use App\Infrastructure\Persistence\EloquentInventoryRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends  ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            IInventoryRepository::class,
            EloquentInventoryRepository::class
        );
    }
}
