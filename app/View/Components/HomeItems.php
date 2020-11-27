<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HomeItems extends Component
{

    public $posts;
    public $translated;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts, $translated)
    {
        $this->posts = $posts;
        $this->translated = $translated;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.home-items');
    }
}
