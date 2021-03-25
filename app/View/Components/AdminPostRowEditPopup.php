<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminPostRowEditPopup extends Component
{
    public $id;
    public $row;
    public $value;
    public $textarea;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $row, $value)
    {
        $this->id = $id;
        $this->row = $row;
        $this->value = $value;
        $this->textarea = strpos($row,'description')!==false ? true : false ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin-post-row-edit-popup');
    }
}
