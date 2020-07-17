<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostImage extends Model
{
    protected $fillable = ['path', 'size', 'version'];

    public $appends = ['url'];

    public function getUrlAttribute() {
        return asset(Storage::disk('local')->url($this->path)); //asset() works thanks to php artisan storage:link
    }

    public function setSizeAttribute($value) {
        $this->attributes['size'] = intval($value / 1024);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
