<?php

namespace App\Modules\Website\Models;

use App\Modules\Post\Models\Post;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Subscriber\Models\Subscriber;
use App\Modules\Website\Models\SubscriberWebsite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Website\Database\factories\WebsiteFactory;

class Website extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  public function subscribers()
  {
    return $this->belongsToMany(Subscriber::class, $table = 'subscriber_website')->using(SubscriberWebsite::class)
      ->as('subscription_details')->withTimestamps();
  }

  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  protected static function newFactory()
  {
    return WebsiteFactory::new();
  }
}
