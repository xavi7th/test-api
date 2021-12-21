<?php

namespace App\Modules\Post\Notifications;

use Illuminate\Bus\Queueable;
use App\Modules\Post\Models\Post;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;

class PostCreatedNotification extends Notification implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $post;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $user
   * @return array
   */
  public function via($user)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $user
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($user)
  {
    return (new MailMessage)
      ->subject('New Post from' . $this->post->website->name)
      ->greeting('Hi there,')
      ->line('A new post titled: ' . $this->post->title . ' was just created on ' . $this->post->website->name)
      ->line('A short description is below ')
      ->line(new HtmlString($this->post->description))
      ->line('You can check out the full post on their website')
      ->with('Cheers,')
      ->salutation(config('app.name'));
  }
}
