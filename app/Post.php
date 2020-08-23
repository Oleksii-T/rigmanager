<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostImage;
use App\User;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use App\Favourite;
use App\Http\Controllers\Traits\Tags;

class Post extends Model
{
    use Searchable, Tags;

    protected $appends = ['tag_readable', 'tag_map'];

    protected $fillable = [ //mass assigment
        'title', 'description', 'tag_encoded', 'condition', 'location', 'cost', 
        'user_email', 'user_phone', 'viber', 'telegram', 'whatsapp'
    ];

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

    public function getTagReadableAttribute()
    {
        return $this->getTagReadable($this->tag_encoded);
    }

    public function getTagMapAttribute()
    {
        return $this->getTagMap($this->tag_encoded);
    }

}
