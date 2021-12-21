<?php

namespace App\Modules\Post\Console;

use Illuminate\Console\Command;
use App\Modules\Post\Models\Post;
use Illuminate\Support\Facades\Notification;
use App\Modules\Post\Notifications\PostCreatedNotification;

class SendPostNotificationMailsCommand extends Command
{
  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'new_posts:notify';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send a notification fo new posts to existing subscribers';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    foreach (Post::mailNotSent()->with('website.subscribers')->get() as $post) {
      Notification::send($post->website->subscribers, new PostCreatedNotification($post));

      /** Indicate that this email has been sent already to prevent sending duplicate stories */
      $post->mail_sent_at = now();
      $post->save();
    }
  }
}
