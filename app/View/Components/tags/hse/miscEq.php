<?php

namespace App\View\Components\tags\hse;

use Illuminate\View\Component;

class miscEq extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tags.hse.misc-eq');
    }
}