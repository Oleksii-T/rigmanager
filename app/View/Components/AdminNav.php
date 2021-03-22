<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminNav extends Component
{
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active=null)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin-nav');
    }
}
