<?php

namespace App\Http\Livewire\Alert;

use Livewire\Component;
use App\Models\Alert;
use App\Traits\WithAlert;
use App\Traits\WithModal;

class Unknown extends Component
{
    use WithAlert;
    use WithModal;

    public $alerts;
    public $a;

    public function render()
    {
        $this->alerts = $this->unknown();

        return view('livewire.alert.unknown');
    }

    public function showModal($id)
    {
        $this->a = Alert::find($id);
        
        if($this->a){
            $this->modal('show', '#show');
        }
    }

    public function hideShowModal($id)
    {
        $this->modal('hide', '#show');
    }
}
