<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\EmpleadoRepositoryInterface;
use App\Repositories\EmpleadoRepository;

use App\Contracts\Resolvers\CalculadorSalarioResolverInterface;
use App\Resolvers\CalculadorSalarioResolver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmpleadoRepositoryInterface::class, EmpleadoRepository::class);
        $this->app->bind(CalculadorSalarioResolverInterface::class, CalculadorSalarioResolver::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
