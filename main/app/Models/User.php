<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  public function isSuperAdmin(): bool
  {
    return $this instanceof SuperAdmin;
  }

  public function isAdmin(): bool
  {
    return $this instanceof Admin;
  }

  public function isAppUser(): bool
  {
    return $this instanceof AppUser;
  }

  public function getUserType()
  {
    switch (true) {
      case $this->isAdmin():
        $user_type = ['isAdmin' => true];
        break;
      case $this->isSuperAdmin():
        $user_type = ['isSuperAdmin' => true];
        break;
      case $this->isAppUser():
        $user_type = ['isAppUser' => true];
        break;
      default:
        $user_type = [];
        break;
    }
    return array_merge($user_type, ['user_type' => strtolower($this->getType())]);
  }


  public function getType(): string
  {
    return class_basename(get_class($this));
  }
}
