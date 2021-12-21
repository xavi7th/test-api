<?php

namespace App\Modules\Post\Events;

use App\Modules\Post\Models\Post;
use Illuminate\Queue\SerializesModels;

class PostCreated
{
  use SerializesModels;

  /**
   * The sale record object
   *
   * @var Post
   */
  public $post;

  public function __construct(Post $post)
  {
    $this->post = $post;
  }
}
