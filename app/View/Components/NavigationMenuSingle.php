<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavigationMenuSingle extends Component
{
    public $name;
    public $icon;
    public $link;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $icon, $link)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navigation-menu-single');
    }
}
