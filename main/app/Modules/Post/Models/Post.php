<?php

namespace App\Modules\Post\Models;

use App\Modules\Website\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Modules\Post\Database\factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
  use HasFactory;

  protected $fillable = ['website_id', 'title', 'description', 'content',];

  protected $casts = ['website_id' => 'int'];
  protected $dates = ['mail_sent_at'];

  public function website()
  {
    return $this->belongsTo(Website::class);
  }

  public function scopeMailNotSent(Builder $query)
  {
    $query->where('mail_sent_at', null);
  }

  protected static function newFactory()
  {
    return PostFactory::new();
  }
}
