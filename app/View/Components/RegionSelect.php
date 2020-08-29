<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RegionSelect extends Component
{
    public $locale;
    public $defValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($locale, $defValue = null )
    {
        $this->locale = $locale;
        $this->defValue = $defValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        switch ($this->locale) {
            case 'uk':
                return view('components.region.select-uk');
                break;
            case 'ru':
                return view('components.region.select-ru');
                break;
            case 'en':
                return view('components.region.select-en');
                break;
            default:
                break;
        }
        
    }
}
