<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EquipmentTags extends Component
{
    public $btnText;
    public $submitBtnText;
    public $submitBtnClass;
    public $modalHelp;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($role)
    {
        if ( $role == "1" ) {
            $this->btnText = __('ui.tags');
            $this->submitBtnText = __('ui.submit');
            $this->submitBtnClass = 'post-create';
            $this->modalHelp = __('ui.tagsModalHelp');
        } else if ( $role == "2" ) {
            $this->btnText = __('ui.searchEquipment');
            $this->submitBtnText = __('ui.search');
            $this->submitBtnClass = 'post-search';
            $this->modalHelp = null;
        } else if ( $role == "3" ) {
            $this->btnText = __('ui.choose');
            $this->submitBtnText = __('ui.submit');
            $this->submitBtnClass = 'post-mailer';
            $this->modalHelp = __('ui.tagsModalHelp');
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.equipment-tags');
    }
}
