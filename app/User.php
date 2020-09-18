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

    protected $appends = ['phone_readable', 'phone_intern'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activation_token', 'phone_raw', 'viber', 'telegram', 
        'whatsapp', 'language'
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

    public function setPhoneRawAttribute($value)
    {
        $this->attributes['phone_raw'] = substr(preg_replace('/[^0-9]+/', '', $value), 0, 10);
    }

    public function getPhoneReadableAttribute() {
        $phone = $this->phone_raw;
        if ($phone){
            for ($i=strlen($phone)-1; $i >= 0 ; $i--) {
                if ($i==1){
                    $phone = substr_replace($phone, ' (', $i, 0);
                }
                else if ($i == 3) {
                    $phone = substr_replace($phone, ') ', $i, 0);
                } else if ($i==8 || $i==6) {
                    $phone = substr_replace($phone, ' ', $i, 0);
                }
            }
        }
        return $phone;
    }

    public function getPhoneInternAttribute() {
        $phone = $this->phone_readable;
        return $phone ? '+38'.$phone : $phone;
    }
}
