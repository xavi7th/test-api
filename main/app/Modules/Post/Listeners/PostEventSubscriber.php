<?php

namespace App\Modules\Post\Listeners;

use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Modules\Post\Events\PostConfirmed;
use App\Modules\Post\Events\PostCreated;
use App\Modules\Post\Notifications\PostCreatedNotification;

class PostEventSubscriber implements ShouldQueue
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Register the listeners for the subscriber.
   */
  public function subscribe(Dispatcher $events)
  {
    $events->listen(PostCreated::class, 'App\Modules\Post\Listeners\PostEventSubscriber@onPostCreated');
  }


  static function onPostCreated(PostCreated $event)
  {

    Notification::send($event->post->website->subscribers, new PostCreatedNotification($event->post));

    $event->post->mail_sent_at = now();
    $event->post->save();
  }
}
