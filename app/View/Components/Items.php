<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Items extends Component
{

    public $posts;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts, $type)
    {
        $this->posts = $posts;
        $this->type = $type;
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
