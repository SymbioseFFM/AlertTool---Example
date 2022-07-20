<?php

namespace App\Http\Livewire\Sensor;

use Livewire\Component;
use App\Traits\WithAlert;

class Threshold extends Component
{
    use WithAlert;

    public $sensors;

    public function render()
    {
        $this->sensors = $this->sensorThreshold();

        return view('livewire.sensor.threshold');
    }
}
