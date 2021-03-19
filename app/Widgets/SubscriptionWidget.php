<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Subscription;

class SubscriptionWidget extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Subscription::count();
        $string = 'Subscriptions';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-credit-card',
            'title'  => "{$count} {$string}",
            'text'   => 'You have ' . $count . ' subscriptions in your database. Click on button below to view all subscriptions.',
            'button' => [
                'text' => 'View all Subscriptions',
                'link' => 'admin/subscriptions',
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
