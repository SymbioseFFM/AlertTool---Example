<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{

    public $title;
    public $tableHeadings;
    public $createModal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $tableHeadings, $createModal = NULL)
    {
        $this->title = $title;
        $this->tableHeadings = $tableHeadings;
        $this->tableHeadings = explode(",", $tableHeadings);
        $this->createModal = $createModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
