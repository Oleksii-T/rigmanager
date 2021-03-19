<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\ProfileImage;
use App\Subscription;
use App\Favourite;
use App\Partner;
use App\Mailer;
use App\Post;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    protected $appends = ['phone_readable', 'phone_intern', 'is_social', 'is_standart', 'is_pro'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url_name', 'name', 'email', 'password', 'activation_token', 'phone_raw', 'viber', 'telegram',
        'whatsapp', 'language', 'facebook_id', 'google_id'
    ];
    protected $guarder = [
        'id', 'is_banned', 'email_verified_at', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
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

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    public function partner()
    {
        return $this->hasOne(Partner::class)->latest();
    }

    public function mailers()
    {
        return $this->hasMany(Mailer::class);
    }

    public function favPosts()
    {
        //return $this->belongsToMany(Post::class)->using(Favourite::class);
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function getIsSocialAttribute() {
        if ( $this->google_id || $this->facebook_id ) {
            return true;
        }
        return false;
    }

    public function setPhoneRawAttribute($value)
    {
        $this->attributes['phone_raw'] = substr(preg_replace('/[^0-9]+/', '', $value), 0, 10);
    }

    public function getIsStandartAttribute() {
        if ( $this->subscription && $this->subscription->is_standart ) {
            return true;
        }
        return false;
    }

    public function getIsProAttribute() {
        if ( $this->subscription && $this->subscription->is_pro ) {
            return true;
        }
        return false;
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
