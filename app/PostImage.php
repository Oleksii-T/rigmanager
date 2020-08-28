<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostImage extends Model
{
    protected $fillable = ['serial_no', 'path', 'size', 'version'];

    public $appends = ['url', 'size_b', 'name'];

    public function getUrlAttribute() {
        return asset(Storage::disk('local')->url($this->path)); //asset() works thanks to php artisan storage:link
    }

    public function setSizeAttribute($value) {
        $this->attributes['size'] = intval($value / 1024); //save size in KB
    }

    public function getSizeBAttribute() {
        return $this->size * 1024;
    }
    public function getNameAttribute() {
        return substr( strstr( $this->path, '/' ), 1 ) ;
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
