<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilteredItems extends Component
{
    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.filtered-items');
    }
}
