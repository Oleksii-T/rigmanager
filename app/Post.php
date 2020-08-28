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

    protected $appends = ['tag_readable', 'tag_map', 'condition_readable', 'cost_readable', 'user_phone_readable', 'user_phone_intern'];

    protected $fillable = [ //mass assigment
        'title', 'description', 'tag_encoded', 'condition', 'province', 'town', 'cost', 
        'currency', 'user_email', 'user_phone_raw', 'viber', 'telegram', 'whatsapp'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only('title', 'description', 'province', 'town');
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
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function setCostAttribute($value)
    {
        $this->attributes['cost'] = preg_replace('/[^0-9.]+/', '', $value);
    }
    
    public function setUserPhoneRawAttribute($value)
    {
        $this->attributes['user_phone_raw'] = preg_replace('/[^0-9]+/', '', $value);
    }

    public function getCostReadableAttribute()
    {
        $cost = strval($this->cost);
        $coins = strstr($cost, '.');
        if (!$coins) {
            $cost = $cost.".00";
        }
        else if (strlen($coins) != 3 ) {
            $cost = $cost."0";
        }
        $step = 1;
        $commaIndexes = array();
        for ($i=strlen($cost)-4; $i > 0 ; $i--) { 
            if ($step == 3) {
                $commaIndexes[] = $i;
                $step = 1;
            } else {
                $step++;
            }
        }
        foreach ($commaIndexes as $commaIndex) {
            $cost = substr_replace($cost, ',', $commaIndex, 0);
        }
        $currency = $this->currency=="UAH" ? '₴' : '$' ;
        $cost = substr_replace($cost, $currency, 0, 0);
        return $cost;
    }

    public function getUserPhoneReadableAttribute() {
        $phone = $this->user_phone_raw;
        if ($phone){
            $phone = '('.$phone;
            for ($i=0; $i < strlen($phone) ; $i++) { 
                if ($i == 4) {
                    $phone = substr_replace($phone, ') ', $i, 0);
                    $i+=2;
                } else if ($i==8 || $i==11) {
                    $phone = substr_replace($phone, '-', $i, 0);
                    $i++;
                }
            }
        }
        return $phone;
    }
    public function getUserPhoneInternAttribute() {
        $phone = $this->user_phone_readable;
        return $phone ? '+38 '.$phone : $phone;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getConditionReadableAttribute() {
        switch ($this->condition) {
            case 1:
                return __('ui.other');
            break;
            case 2:
                return __('ui.conditionNew');
            break;
            case 3:
                return __('ui.conditionSH');
            break;
            case 4:
                return __('ui.conditionForParts');
                break;
        }
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
