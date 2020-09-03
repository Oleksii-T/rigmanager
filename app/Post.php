<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostImage;
use App\User;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use App\Favourite;
use App\Http\Controllers\Traits\Tags;
use App\Utilities\FilterBuilder;

class Post extends Model
{
    use Searchable, Tags;

    protected $appends = ['tag_readable', 'tag_map', 'condition_readable', 'cost_readable', 'user_phone_readable', 'user_phone_intern', 'region_readable'];

    protected $fillable = [ //mass assigment
        'title', 'description', 'tag_encoded', 'condition', 'region_encoded', 'town', 'cost', 
        'currency', 'user_email', 'user_phone_raw', 'viber', 'telegram', 'whatsapp'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only('title', 'description', 'town');
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

    public function getRegionReadableAttribute()
    {
        switch ($this->region_encoded) {
            case '1':
                return __('ui.regionCrimea');
                break;
            case '2':
                return __('ui.regionVinnytsia');
                break;
            case '3':
                return __('ui.regionVolyn');
                break;
            case '4':
                return __('ui.regionDnipropetrovsk');
                break;
            case '5':
                return __('ui.regionDonetsk');
                break;
            case '6':
                return __('ui.regionZhytomyr');
                break;
            case '7':
                return __('ui.regionCarpathian');
                break;
            case '8':
                return __('ui.regionZaporozhye');
                break;
            case '9':
                return __('ui.regionIvano-Frankivsk');
                break;
            case '10':
                return __('ui.regionKiev');
                break;
            case '11':
                return __('ui.regionKirovograd');
                break;
            case '12':
                return __('ui.regionLuhansk');
                break;
            case '13':
                return __('ui.regionLviv');
                break;
            case '14':
                return __('ui.regionMykolaiv');
                break;
            case '15':
                return __('ui.regionOdessa');
                break;
            case '16':
                return __('ui.regionPoltava');
                break;
            case '17':
                return __('ui.regionRivne');
                break;
            case '18':
                return __('ui.regionSumy');
                break;
            case '19':
                return __('ui.regionTernopil');
                break;
            case '20':
                return __('ui.regionKharkiv');
                break;
            case '21':
                return __('ui.regionKherson');
                break;
            case '22':
                return __('ui.regionKhmelnytsky');
                break;
            case '23':
                return __('ui.regionCherkasy');
                break;
            case '24':
                return __('ui.regionChernivtsi');
                break;
            case '25':
                return __('ui.regionChernihiv');
                break;
            default:
                return __('ui.notSpecified');
        }
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
            for ($i=strlen($phone)-1; $i >= 0 ; $i--) {
                if ($i==1){
                    $phone = substr_replace($phone, ' (', $i, 0);
                } else if ($i == 3) {
                    $phone = substr_replace($phone, ') ', $i, 0);
                } else if ($i==8 || $i==6) {
                    $phone = substr_replace($phone, ' ', $i, 0);
                }
            }
        }
        return $phone;
    }
    
    public function getUserPhoneInternAttribute() {
        $phone = $this->user_phone_readable;
        return $phone ? '+38'.$phone : $phone;
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
                return __('ui.notSpecified');
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

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\PostFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

}
