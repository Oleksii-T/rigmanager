<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostImage;
use App\User;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use App\Favourite;

class Post extends Model
{
    use Searchable;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only('title', 'description', 'location', 'condition');
        return $array;
    }

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
