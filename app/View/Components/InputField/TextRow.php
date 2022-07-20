<?php

namespace App\View\Components\InputField;

use Illuminate\View\Component;

class TextRow extends Component
{
    public $title;
    public $attribute;
    public $placeholder;

    public $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $attribute, $placeholder, $model)
    {
        $this->title = $title;
        $this->attribute = $attribute;
        $this->placeholder = $placeholder;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-field.text-row');
    }
}
