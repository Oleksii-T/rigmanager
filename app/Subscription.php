<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Subscription extends Model
{
    protected $fillable = ['is_active', 'role', 'activated_at', 'payed', 'updated_at', 'expire_at', 'history'];

    protected $appends = ['role_readable', 'expite_at_readable', 'is_standart', 'is_pro'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setHistoryAttribute($value)
    {
        $this->attributes['history'] = json_encode($value);
    }

    public function getHistoryAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getRoleReadableAttribute() {
        switch ($this->role) {
            case 1:
                return __('ui.planStandart');
            case 2:
                return __('ui.planPro');
            default:
                return __('ui.error');
        }
    }

    public function getExpireAtReadableAttribute() {
        return Carbon::parse($this->expire_at)->isoFormat('LL');
    }

    public function getIsStandartAttribute() {
        if ($this->is_active && ($this->role==1 || $this->role==2)) {
            return true;
        } else {
            return false;
        }
    }

    public function getIsProAttribute() {
        if ($this->is_active && $this->role==2) {
            return true;
        } else {
            return false;
        }
    }
}
