<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\Traits\Tags;

class Mailer extends Model
{
    use Tags;

    protected $appends = [
        'authors_readable', 'authors_map', 'authors_string', 'tags_readable', 'tags_map', 'tags_string'
    ];

    protected $fillable = [
        'tags_encoded', 'keywords', 'authors_encoded', 'is_active'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTagsEncodedAttribute($value) {
        if (!$value) {
            $this->attributes['tags_encoded'] = null;
        }
        else if (!is_array($value)) {
            $arrTags = explode(' ', $value);
            $this->attributes['tags_encoded'] = json_encode($arrTags);
        } else {
            $this->attributes['tags_encoded'] = json_encode($value);
        }
    }

    public function getTagsEncodedAttribute($value)
    {
        return json_decode($value);
    }

    public function setAuthorsEncodedAttribute($value) {
        if (!$value) {
            $this->attributes['authors_encoded'] = null;
        }
        else if (!is_array($value)) {
            $arrTags = explode(' ', $value);
            $this->attributes['authors_encoded'] = json_encode($arrTags);
        } else {
            $this->attributes['authors_encoded'] = json_encode($value);
        }
    }

    public function getAuthorsEncodedAttribute($value)
    {
        return json_decode($value);
    }

    public function getTagsReadableAttribute() {
        if (!$this->tags_encoded) {
            return null;
        }
        $tags = $this->tags_encoded;
        foreach ($tags as &$tag) {
            $tag = $this->getTagReadable($tag);
        }
        return $tags;
    }

    public function getTagsMapAttribute() {
        if (!$this->tags_encoded) {
            return null;
        }
        foreach ($this->tags_encoded as $tag) {
            $tags[$tag] = $this->getTagReadable($tag);
        }
        return $tags;
    }

    public function getTagsStringAttribute() {
        return $this->tags_encoded ? implode(' ', $this->tags_encoded) : null;
    }

    public function getAuthorsReadableAttribute() {
        if (!$this->authors_encoded) {
            return null;
        }
        $authors = $this->authors_encoded;
        foreach ($authors as &$author) {
            $author = User::findOrfail($author)->name;
        }
        return $authors;
    }

    public function getAuthorsMapAttribute() {
        if (!$this->authors_encoded) {
            return null;
        }
        foreach ($this->authors_encoded as $author) {
            $authors[$author] = User::findOrfail($author)->name;
        }
        return $authors;
    }

    public function getAuthorsStringAttribute() {
        return $this->authors_encoded ? implode(' ', $this->authors_encoded) : null;
    }
    
}
