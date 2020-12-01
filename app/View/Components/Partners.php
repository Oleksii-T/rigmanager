<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Partner;

class Partners extends Component
{

    public $partners;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->partners = Partner::where('is_on_home', true)->take(7)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.partners');
    }
}
