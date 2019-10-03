<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $table="users";
        public function posts()
        {
        return $this->hasMany('App\Post');
        }
            public function likes()
        {
        return $this->hasMany('App\Like');
        }
      public function comments()
      {
        return $this->hasMany('App\Comment');
      }
      public function consultations()
      {
          return $this->hasMany('App\Consultation');
      }
      public function adoptions()
      {
          return $this->hasMany('App\Adoption');
      }
      public function streetpets()
      {
          return $this->hasMany('App\Streetpet');
      }
    public function doctor()
    {
        return $this->hasOne('App\Doctor');
    }
    public function followers()
    {
        return $this->hasMany('App\Follower');
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'leader_id')->withTimestamps();
    }

}
