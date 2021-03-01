<?php

namespace App;
use App\Http\Controllers\MailerController;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\Tags;
use App\User;

class Mailer extends Model
{
    use Tags;

    protected $appends = [
        'author_name', 'types_map', 'types_readable', 'tag_map', 'conditions_map', 'conditions_readable', 
        'roles_map', 'types_readable', 'threads_map', 'threads_map', 'cost_from_readable', 'cost_to_readable',
        'all_conditions', 'all_types', 'all_roles', 'all_threads', 'region_name', 'tag_is_eq', 'author_url_name'
    ];

    protected $fillable = [
        'title', 'tag', 'keyword', 'author', 'is_active', 'type', 'currency', 'cost_from', 'cost_to', 'region',
        'condition', 'thread', 'role', 'found_posts'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setCostFromAttribute($value) {
        $value = preg_replace('/[^0-9.]+/', '', $value);
        $this->attributes['cost_from'] = $value=='0.00' ? null : $value;
    }
    
    public function setCostToAttribute($value) {
        $value = preg_replace('/[^0-9.]+/', '', $value);
        $this->attributes['cost_to'] = $value=='0.00' ? null : $value;
    }

    public function setTypeAttribute($value) {
        if (!$value) {
            $this->attributes['type'] = null;
        } else {
            $this->attributes['type'] = json_encode($value);
        }
    }

    public function getTypeAttribute($value) {
        return json_decode($value);
    }

    public function setThreadAttribute($value) {
        if (!$value) {
            $this->attributes['thread'] = null;
        } else {
            $this->attributes['thread'] = json_encode($value);
        }
    }

    public function getThreadAttribute($value) {
        return json_decode($value);
    }

    public function setConditionAttribute($value) {
        if (!$value) {
            $this->attributes['condition'] = null;
        } else {
            $this->attributes['condition'] = json_encode($value);
        }
    }

    public function getConditionAttribute($value) {
        return json_decode($value);
    }

    public function setFoundPostsAttribute($value) {
        if (!$value) {
            $this->attributes['found_posts'] = null;
        } else {
            $this->attributes['found_posts'] = json_encode($value);
        }
    }

    public function getFoundPostsAttribute($value) {
        if (!$value) {
            return array();
        }
        return json_decode($value);
    }

    public function setRoleAttribute($value) {
        if (!$value) {
            $this->attributes['role'] = null;
        } else {
            $this->attributes['role'] = json_encode($value);
        }
    }

    public function getRoleAttribute($value) {
        return json_decode($value);
    }

    public function getCostFromReadableAttribute() {
        return formatNumberToCost($this->cost_from, $this->currency);
    }

    public function getCostToReadableAttribute() {
        return formatNumberToCost($this->cost_to, $this->currency);
    }

    public function getAllConditionsAttribute() {
        return $this->condition==[1,2,3,4]
            ? true
            : false;
    }

    public function getTagIsEqAttribute() {
        return $this->isEquipment($this->tag);
    }

    public function getAllTypesAttribute() {
        return $this->type==[1,2,3,4,5,6]
            ? true
            : false;
    }

    public function getAllRolesAttribute() {
        return $this->role==[1,2]
            ? true
            : false;
    }

    public function getAllThreadsAttribute() {
        return $this->thread==[1,2]
            ? true
            : false;
    }

    public function getRegionNameAttribute() {
        switch ($this->region) {
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
            case '30':
                return __('ui.import');
                break;
            default:
                return __('ui.notSpecified');
        }
    }

    public function getAuthorNameAttribute() {
        return User::find( (int) $this->author)->name;
    }

    public function getAuthorUrlNameAttribute() {
        return User::find( (int) $this->author)->url_name;
    }

    public function getConditionsMapAttribute() {
        foreach ($this->condition as $value) {
            switch ($value) {
                case 1:
                    $conditionsMap[$value] = __('ui.notSpecified');
                break;
                case 2:
                    $conditionsMap[$value] = __('ui.conditionNew');
                break;
                case 3:
                    $conditionsMap[$value] = __('ui.conditionSH');
                break;
                case 4:
                    $conditionsMap[$value] = __('ui.conditionForParts');
                    break;
            }
        }
        return $conditionsMap;
    }

    public function getConditionsReadableAttribute() {
        return implode(", ", $this->getConditionsMapAttribute());
    }

    public function getTypesMapAttribute() {
        foreach ($this->type as $type) {
            switch ($type) {
                case 1:
                    $typesMap[$type] = __('ui.postTypeSell');
                break;
                case 2:
                    $typesMap[$type] = __('ui.postTypeBuy');
                break;
                case 3:
                    $typesMap[$type] = __('ui.postTypeRentFull');
                break;
                case 4:
                    $typesMap[$type] = __('ui.postTypeLeasFull');
                    break;
                case 5:
                    $typesMap[$type] = __('ui.postTypeGiveS');
                    break;
                case 6:
                    $typesMap[$type] = __('ui.postTypeGetS');
                    break;
                case 7:
                    $typesMap[$type] = __('ui.tender');
                    break;
                default:
                    $typesMap[$type] = __('ui.notSpecified');
                    break;
            }
        }
        return $typesMap;
    }

    public function getTypesReadableAttribute() {
        return implode(", ", $this->getTypesMapAttribute());
    }

    public function getRolesMapAttribute() {
        foreach ($this->role as $role) {
            switch ($role) {
                case 1:
                    $rolesMap[$role] = __('ui.postRolePrivate');
                    break;
                case 2:
                    $rolesMap[$role] = __('ui.postRoleBusiness');
                    break;
            }
        }
        return $rolesMap;
    }

    public function getRolesReadableAttribute() {
        return implode(", ", $this->getRolesMapAttribute());
    }

    public function getThreadsMapAttribute() {
        foreach ($this->thread as $thread) {
            switch ($thread) {
                case 1:
                    $threadsMap[$thread] = __('ui.equipment');
                    break;
                case 2:
                    $threadsMap[$thread] = __('ui.service');
                    break;
            }
        }
        return $threadsMap;
    }

    public function getThreadsReadableAttribute() {
        return implode(", ", $this->getThreadsMapAttribute());
    }

    public function getTagMapAttribute() {
        return $this->getTagMap($this->tag);
    }
}
