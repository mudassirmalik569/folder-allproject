<?php

namespace App\Providers;

use App\Models\Workorder;
use App\Models\WorkorderStatus;
use App\Observers\WorkorderObserver;
use App\Observers\WorkorderStatusObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Workorder::observe(WorkorderObserver::class);
        WorkorderStatus::observe(WorkorderStatusObserver::class);
    }
}
