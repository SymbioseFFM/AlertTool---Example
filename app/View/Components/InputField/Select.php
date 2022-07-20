<?php

namespace App\View\Components\InputField;

use Illuminate\View\Component;


class Select extends Component
{
    public $title;
    public $options;
    public $binding;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $model, $binding)
    {
        $model = "App\Models\\$model";

        $this->binding = $binding;
        $this->title = $title;
        $this->options = $model::orderBy('name', 'ASC')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-field.select');
    }
}
