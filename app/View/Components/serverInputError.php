<?php

namespace App\View\Components;

use Illuminate\View\Component;

class serverInputError extends Component
{
    public $errorName;
    public $inputName;
    public $errorClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($errorName, $inputName, $errorClass)
    {
        $this->errorName = $errorName;
        $this->inputName = $inputName;
        $this->errorClass = $errorClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.server-input-error');
    }
}
