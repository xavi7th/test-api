<?php

namespace App\Modules\Post\Providers;

use App\Modules\Post\Listeners\PostEventSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class PostEventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    //
  ];

  /**
   * The subscriber classes to register.
   *
   * @var array
   */
  protected $subscribe = [
    PostEventSubscriber::class,
  ];
}
