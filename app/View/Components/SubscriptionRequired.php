<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubscriptionRequired extends Component
{
    public $role;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($role)
    {
        switch ($role) {
            case '1':
                $this->role = __('ui.planPremium');
            break;
            case '2':
                $this->role = __('ui.planPremium+');
            break;
            default:
                $this->role = __('ui.planPremium');
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.subscription-required');
    }
}
