<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Project\Created' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\Project\Updated' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\Project\Deleted' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\Page\Created' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\Page\Updated' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\Page\Deleted' => [
            //'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
