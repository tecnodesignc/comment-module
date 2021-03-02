<?php

namespace Modules\Comments\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Comments\Events\CommentWasCreated;
use Modules\Comments\Events\Handlers\CommentBroadcast;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CommentWasCreated::class => [
           CommentBroadcast::class,
        ],


    ];
}
