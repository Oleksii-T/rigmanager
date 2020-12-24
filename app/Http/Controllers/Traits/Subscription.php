<?php

namespace App\Http\Controllers\Traits;

use App\Subscriptions;
use Carbon\Carbon;

trait Subscription
{
    public function freeAccess() {
        auth()->user()->subscription()->save(new \App\Subscription([
            'is_active' => true,
            'role' => 2,
            'payment' => 0,
            'activated_at' => Carbon::now(),
            'expire_at' => Carbon::create(2021, 3, 1, 0, 0, 0), // March 1, 2021 (01/03/2021)
        ]));
    }

    public function isSubscribed() {
        if (auth()->check() && auth()->user()->subscription && auth()->user()->subscription->is_active) {
            return true;
        } 
        return false;
    }

    public function isPremium() {
        if ($this->isSubscribed() && (auth()->user()->subscription->role == 1 || auth()->user()->subscription->role == 2) ) {
            return true;
        }
        return false;
    }
    
    public function isPremiumPlus() {
        if ($this->isSubscribed() && auth()->user()->subscription->role == 2) {
            return true;
        }
        return false;
    }

    public function checkAll() {

    }

    private function expire($user) {

    }

    public function update($user) {

    }

    private function makeHistory() {
        $foo[] = [
            'period' => [
                'from' => '20.01.2021',
                'to' => '20.02.2021'
            ],
            'cost' => 300,
            'role' => 2,
            'comment' => '50% off'
        ];
        return $foo;
    }

    public function terminate() {

    }

}