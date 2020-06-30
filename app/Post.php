<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostImage;
use App\User;
use Carbon\Carbon;
//use App\Favourite;

class Post extends Model
{
    protected $fillable = [ //mass assigment
        'title', 'description', 'tag', 'condition', 'location', 'cost', 'user_email', 'user_phone', 'viber', 'telegram', 'whatsapp'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(PostImage::class);
    }

    public function favOfUser()
    {
        //return $this->belongsToMany(User::class)->using(Favourite::class);
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
