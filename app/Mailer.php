<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Controllers\MailerController;

class Mailer extends Model
{
    protected $appends = ['authors_names', 'authors_ids_and_names', 'tags_names', 'tags_ids_and_names'];

    protected $fillable = [ //mass assigment
        'tags', 'keywords', 'authors', 'is_active'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getAuthorsNamesAttribute() {
        if (!$this->authors) {
            return null;
        }
        $authors = explode(" ", $this->authors);
        foreach ($authors as &$author) {
            $author = User::findOrfail($author)->name;
        }
        return $authors;
    }

    public function getAuthorsIdsAndNamesAttribute() {
        if (!$this->authors) {
            return null;
        }
        foreach (explode(" ", $this->authors) as $author) {
            $authors[$author] = User::findOrfail($author)->name;
        }
        return $authors;
    }

    public function getTagsNamesAttribute() {
        if (!$this->tags) {
            return null;
        }
        $mailer = new MailerController;
        $tags = explode(" ", $this->tags);
        foreach ($tags as &$tag) {
            $tag = $mailer->getTagPathAsString($tag);
        }
        return $tags;
    }

    public function getTagsIdsAndNamesAttribute() {
        if (!$this->tags) {
            return null;
        }
        $mailer = new MailerController;
        foreach (explode(" ", $this->tags) as $tag) {
            $tags[$tag] = $mailer->getTagPathAsString($tag);
        }
        return $tags;
    }
    
}
