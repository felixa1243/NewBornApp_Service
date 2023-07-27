<?php

namespace App\Providers;

use App\Repositories\IMotherRepository;
use App\Repositories\MotherRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IMotherRepository::class,MotherRepository::class);
    }
}
