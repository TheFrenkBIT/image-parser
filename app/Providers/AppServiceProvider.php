<?php

namespace App\Providers;

use App\Factories\QueueFactory;
use App\Services\EventService;
use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\ImageService::class, \App\Services\ImageService::class);

        $this->app->singleton(QueueFactory::class,
            function () {
                return new QueueFactory(
                    new AMQPStreamConnection(
                        config('rabbit_mq.host'),
                        config('rabbit_mq.port'),
                        config('rabbit_mq.user'),
                        config('rabbit_mq.password')
                    )
                );
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
