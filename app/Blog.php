<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class Blog extends Model
{
    protected $appends = ['author_localed', 'title_localed', 'intro_localed', 'body_localed', 'outro_localed', 'description', 'created_at_readable',
        'imgs_arr', 'docs_arr', 'links_arr'];

    protected $guarder = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getAuthorLocaledAttribute() {
        if (!$this->author) {
            return null;
        }
        $a = json_decode($this->author, true);
        return $a[App::getLocale()];
    }

    public function getLinksArrAttribute() {
        if (!$this->links) {
            return null;
        }
        foreach (json_decode($this->links, true) as $i => $l) {
            $ls[] = [
                'name' => $l['name'][App::getLocale()],
                'link' => $l['link']
            ];
        }
        return $ls;
    }

    public function getImgsArrAttribute() {
        if (!$this->imgs) {
            return null;
        }
        return preg_filter('/^/', asset('icons/blog').'/', json_decode($this->imgs));
    }

    public function getDocsArrAttribute() {
        if (!$this->docs) {
            return null;
        }
        foreach (json_decode($this->docs) as $i=>$doc) {
            $docs[] = [
                'index' => $i,
                'name' => substr($doc, strpos($doc, "/")),
                'link' => asset('icons/blog').'/'.$doc
            ];
        }
        return $docs;
    }

    public function getTitleLocaledAttribute() {
        if (!$this->title) {
            return null;
        }
        $t = json_decode($this->title, true);
        return $t[App::getLocale()];
    }

    /*
    public function getIntroLocaledAttribute() {
        if (!$this->intro) {
            return null;
        }
        $i = json_decode($this->intro, true);
        return $i[App::getLocale()];
    }

    public function getBodyLocaledAttribute() {
        if (!$this->body) {
            return null;
        }
        $b = json_decode($this->body, true);
        return $b[App::getLocale()];
    }

    public function getOutroLocaledAttribute() {
        if (!$this->outro) {
            return null;
        }
        $o = json_decode($this->outro, true);
        return $o[App::getLocale()];
    }
    */
    
    public function getDescriptionAttribute() {
        $i = $this->intro ? json_decode($this->intro, true)[App::getLocale()]."\r\n" : '' ;
        $b = $this->body ? json_decode($this->body, true)[App::getLocale()]."\r\n" : '' ;
        $o = $this->outro ? json_decode($this->outro, true)[App::getLocale()] : '' ;
        return $i . $b . $o;
    }

    public function getThumbnailAttribute($value) {
        return asset('icons/blog/'.$value);
    }

    public function getCreatedAtReadableAttribute() {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

}
