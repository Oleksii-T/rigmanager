<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Subscription extends Model
{
    protected $fillable = ['is_active', 'role', 'activated_at', 'updated_at', 'expire_at', 'history'];

    protected $appends = ['role_readable', 'expite_at_readable'];

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
                return __('ui.planPremium');
            case 2:
                return __('ui.planPremium+');
            default:
                return __('ui.error');
        }
    }

    public function getExpireAtReadableAttribute() {
        return Carbon::parse($this->expire_at)->isoFormat('LL');
    }
}
