<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\ProfileImage;
use App\Post;
use App\Favourite;
use App\Mailer;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activation_token', 'phone', 'viber', 'telegram', 'whatsapp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function image()
    {
        return $this->hasOne(ProfileImage::class)->latest();
    }

    public function mailer()
    {
        return $this->hasOne(Mailer::class);
    }

    public function favPosts()
    {
        //return $this->belongsToMany(Post::class)->using(Favourite::class);
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
