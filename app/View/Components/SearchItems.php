<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchItems extends Component
{

    public $posts;
    public $translated;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($p, $t)
    {
        $this->posts = $p;
        $this->translated = $t;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.search-items');
    }
}
