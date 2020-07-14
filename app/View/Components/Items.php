<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Items extends Component
{

    public $posts;
    public $button;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts, $button )
    {
        $this->posts = $posts;
        $this->button = $button;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.items');
    }
}
