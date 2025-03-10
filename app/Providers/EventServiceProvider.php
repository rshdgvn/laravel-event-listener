<?php

namespace App\Providers;

use App\Events\OrderPLaced;
use App\Listeners\NotifyAdminListener;
use App\Listeners\SendMailToCustomer;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        OrderPLaced::class => [
            NotifyAdminListener::class,
            SendMailToCustomer::class,
        ]
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
