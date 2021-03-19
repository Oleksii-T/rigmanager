<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Partner;

class PartnerWidget extends BaseDimmer
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
        $count = Partner::count();
        $string = 'Partners';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-star-half',
            'title'  => "{$count} {$string}",
            'text'   => 'You have ' . $count . ' partners in your database. Click on button below to view all partners.',
            'button' => [
                'text' => 'View all Partners',
                'link' => 'admin/partners',
            ],
            'image' => voyager_asset('images/widget-backgrounds/04.jpg'),
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
