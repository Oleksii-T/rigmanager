<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\Tags;
use App\Utilities\FilterBuilder;
use Laravel\Scout\Searchable;
use App\Favourite;
use App\PostImage;
use Carbon\Carbon;
use App\User;

class Post extends Model
{
    use Searchable, Tags;

    protected $appends = [
        'tag_readable', 'tag_map', 'condition_readable', 'cost_readable', 'user_phone_readable',
        'user_phone_intern', 'region_readable', 'role_readable', 'type_readable', 'origin_lang_readable',
        'type_readable_short', 'created_at_readable', 'preview_image', 'views_amount', 'views_all'
    ];

    protected $guarded = [
        'id', 'is_banned', 'is_premium', 'is_vip', 'priority', 'is_verified', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only(
            'title', 'title_uk', 'title_ru', 'title_en', 'manufacturer', 'part_number',
            'description', 'description_uk', 'description_ru', 'description_en', 'is_active', 'company'
        );
        return $array;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function favOfUser()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getViewsAmountAttribute() {
        if (!$this->views) {
            return 0;
        } else {
            return count($this->views);
        }
    }

    public function getPreviewImageAttribute() {
        if ( $this->images->isEmpty() ) {
            $tag = $this->tag_encoded;
            if ( $this->isService($tag) ) {
                return asset('icons/tags/service.png');
            }
            preg_match_all('/^[0-9]+/', $tag, $m);
            $tag = $m[0][0];
            $image = 'icons/tags/' . $tag . '.png';
            if ( file_exists($image) ) {
                return asset($image);
            } 
            return asset('icons/noImage.svg');
        }
        return $this->images()->where('version', 'optimized')->first()->url;
    }

    public function setViewsAttribute($value)
    {
        $this->attributes['views'] = json_encode($value);
    }

    public function getViewsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setUserTranslationsAttribute($value)
    {
        $this->attributes['user_translations'] = json_encode($value);
    }

    public function getUserTranslationsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getOriginLangReadableAttribute()
    {
        switch ($this->origin_lang) {
            case 'uk':
                return __('ui.ukLang');
                break;
            case 'ru':
                return __('ui.ruLang');
                break;
            case 'en':
                return __('ui.enLang');
                break;
            default:
                return __('ui.notSpecified');
        }
    }

    public function setCostAttribute($value)
    {
        $value = preg_replace('/[^0-9.]+/', '', $value);
        $this->attributes['cost'] = !$value ? null : $value;
    }

    public function setUserPhoneRawAttribute($value)
    {
        $this->attributes['user_phone_raw'] = substr(preg_replace('/[^0-9]+/', '', $value), 0, 10);
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

    public function getTypeReadableAttribute()
    {
        switch ($this->type) {
            case '1':
                return __('ui.postTypeSell');
                break;
            case '2':
                return __('ui.postTypeBuy');
                break;
            case '3':
                return __('ui.postTypeRent');
                break;
            case '4':
                return __('ui.postTypeLeas');
                break;
            case '5':
                return __('ui.postTypeGiveS');
                break;
            case '6':
                return __('ui.postTypeGetS');
                break;
            case '7':
                return __('ui.tender');
                break;
            default:
                return __('ui.notSpecified');
        }
    }

    public function setDescriptionAttribute($value) {
        $value = preg_replace("/\n\s*\n[\s*\n]+/s","\n\n",preg_replace("/\h+/", " ", $value));;
        $this->attributes['description'] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function getTypeReadableShortAttribute()
    {
        switch ($this->type) {
            case '1':
                return __('ui.postTypeSell');
                break;
            case '2':
                return __('ui.postTypeBuy');
                break;
            case '3':
                return __('ui.postTypeRentShort');
                break;
            case '4':
                return __('ui.postTypeLeasShort');
                break;
            case '5':
                return __('ui.service');
                break;
            case '6':
                return __('ui.service');
                break;
            case '7':
                return __('ui.tender');
                break;
            default:
                return __('ui.notSpecified');
        }
    }

    public function getRoleReadableAttribute()
    {
        switch ($this->role) {
            case '1':
                return __('ui.postRolePrivate');
                break;
            case '2':
                return __('ui.postRoleBusiness');
                break;
            default:
                return __('ui.notSpecified');
        }
    }

    public function getCostReadableAttribute()
    {
        $c = $this->currency=="UAH" ? '₴' : '$' ;
        return $c . number_format($this->cost, 2, '.', ',');
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

    public function getCreatedAtReadableAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getConditionReadableAttribute() 
    {
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
