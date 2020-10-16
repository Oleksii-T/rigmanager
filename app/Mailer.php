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
        if (is_array($seTags)) {
            if (is_array($eqTags)) {
                return array_merge($eqTags, $seTags);
            } else {
                return $seTags;
            }
        } else {
            return $eqTags;
        }
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
                    $types[$type] = __('ui.postTypeSellFull');
                    break;
                case 2:
                    $types[$type] = __('ui.postTypeBuyFull');
                    break;
                case 3:
                    $types[$type] = __('ui.postTypeRentFull');
                    break;
                case 4:
                    $types[$type] = __('ui.postTypeLeasFull');
                    break;
                case 5:
                    $types[$type] = __('ui.postTypeGiveS');
                    break;
                case 6:
                    $types[$type] = __('ui.postTypeGetS');
                    break;
                default:
                    break;
            }

        }
        return $types;
    }


}
