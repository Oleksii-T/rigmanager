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
        'authors_map', 'authors_string', 'eq_tags_map', 'se_tags_map', 'types_map', 
        'tags_encoded'
    ];

    protected $fillable = [
        'eq_tags_encoded', 'se_tags_encoded', 'keywords', 'authors_encoded', 'is_active', 'types'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setEqTagsEncodedAttribute($value) 
    {
        $this->attributes['eq_tags_encoded'] = $value ? json_encode($value) : null;
    }

    public function setSeTagsEncodedAttribute($value) 
    {
        $this->attributes['se_tags_encoded'] = $value ? json_encode($value) : null;
    }

    public function getEqTagsEncodedAttribute($value)
    {
        return json_decode($value);
    }

    public function getSeTagsEncodedAttribute($value)
    {
        return json_decode($value);
    }

    // for mailer analizing
    public function getTagsEncodedAttribute()
    {
        $eqTags = $this->eq_tags_encoded;
        $seTags = $this->se_tags_encoded;
        return array_merge($eqTags, $seTags);
    }

    // for index tags showing and edit chosen tags pre-view
    public function getEqTagsMapAttribute() 
    {
        return $this->getTagsMapHelper($this->eq_tags_encoded);
    }

    // for index tags showing and edit chosen tags pre-view
    public function getSeTagsMapAttribute() 
    {
        return $this->getTagsMapHelper($this->se_tags_encoded);
    }

    private function getTagsMapHelper($tags) {
        if (!$tags) {
            return null;
        }
        foreach ($tags as $tag) {
            $result[$tag] = $this->getTagReadable($tag);
        }
        return $result;
    }

    public function setAuthorsEncodedAttribute($value) 
    {
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

    public function getAuthorsMapAttribute() 
    {
        if (!$this->authors_encoded) {
            return null;
        }
        foreach ($this->authors_encoded as $author) {
            $authors[$author] = User::findOrfail($author)->name;
        }
        return $authors;
    }

    public function getAuthorsStringAttribute() 
    {
        return $this->authors_encoded ? implode(' ', $this->authors_encoded) : null;
    }

    public function setTypesAttribute($value) 
    {
        $this->attributes['types'] = $value ? json_encode($value) : null;
    }

    public function getTypesAttribute($value)
    {
        return json_decode($value);
    }

    public function getTypesMapAttribute() 
    {
        if (!$this->types) {
            return null;
        }
        foreach ($this->types as $type) {
            switch ($type) {
                case 1:
                    $types[$type] = __('ui.postTypeSell');
                    break;
                case 2:
                    $types[$type] = __('ui.postTypeBuy');
                    break;
                case 3:
                    $types[$type] = __('ui.postTypeRent');
                    break;
                default:
                    break;
            }
            
        }
        return $types;
    }

    
}
