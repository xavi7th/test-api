<?php

namespace App\Modules\Subscriber\Models;

use App\Modules\Website\Models\Website;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Website\Models\SubscriberWebsite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Subscriber\Database\factories\SubscriberFactory;

class Subscriber extends Model
{
  use HasFactory;

  protected $fillable = ['email'];


  public function subscribed_websites()
  {
    return $this->belongsToMany(Website::class, $table = 'subscriber_website')->using(SubscriberWebsite::class)
      ->as('subscribed_website')->withTimestamps();
  }

  protected static function newFactory()
  {
    return SubscriberFactory::new();
  }
}
