<?php

namespace App\Providers;

use App\Repositories\InfantsRepository;
use App\Repositories\interfaces\IinfantsRepository;
use App\Repositories\interfaces\IMotherRepository;
use App\Repositories\MotherRepository;
use App\Services\IinfantsService;
use App\Services\IMotherService;
use App\Services\InfantsService;
use App\Services\MotherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IMotherRepository::class, MotherRepository::class);
        $this->app->bind(IMotherService::class, MotherService::class);
        $this->app->bind(IinfantsRepository::class, InfantsRepository::class);
        $this->app->bind(IinfantsService::class, InfantsService::class);
    }
}
