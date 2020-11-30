<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = ['is_on_home', 'logo', 'name', 'comment'];

    protected $appends = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
