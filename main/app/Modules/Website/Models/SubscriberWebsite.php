<?php

namespace App\Modules\Website\Models;

use App\Modules\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubscriberWebsite extends Pivot
{
  protected $fillable = ['website_id', 'subscriber_id'];

  protected $casts = [
    'website_id' => 'int',
    'subscriber_id' => 'int',
  ];


  public function website()
  {
    return $this->belongsTo(Website::class);
  }

  public function subscriber()
  {
    return $this->belongsTo(Subscriber::class);
  }
}
