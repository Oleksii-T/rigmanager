<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Items extends Component
{

    public $posts;
    public $button;
    public $translated;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts, $button, $translated)
    {
        $this->posts = $posts;
        $this->button = $button;
        $this->translated = $translated;
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
