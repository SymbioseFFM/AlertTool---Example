<?php

namespace App\Http\Livewire\Sensor;

use Livewire\Component;
use App\Traits\WithAlert;

class Warning extends Component
{
    use WithAlert;

    public $sensors;

    public function render()
    {
        $this->sensors = $this->sensorWarning();
        
        return view('livewire.sensor.warning');
    }
}
