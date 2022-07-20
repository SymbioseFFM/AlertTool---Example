<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableBodyActions extends Component
{
    public $show;
    public $edit;
    public $delete;
    public $pattern;
    public $objectId;
    public $progressed;
    public $reverse;
    public $progressedThreshold;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($show = NULL, $edit = NULL, $delete = NULL, $objectId = NULL, $pattern = NULL, $progressed = NULL, $reverse = NULL, $progressedThreshold = NULL)
    {
        $this->show = $show;
        $this->edit = $edit;
        $this->delete = $delete;
        $this->pattern = $pattern;
        $this->objectId = $objectId;
        $this->progressed = $progressed;
        $this->reverse = $reverse;
        $this->progressedThreshold = $progressedThreshold;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-body-actions');
    }
}
