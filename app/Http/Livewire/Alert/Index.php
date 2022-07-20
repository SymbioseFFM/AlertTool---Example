<?php

namespace App\Http\Livewire\Alert;

use Livewire\Component;
use App\Models\Alert;
use App\Traits\WithAlert;

class Index extends Component
{
    use WithAlert;

    public $count;

    public function mount()
    {
        $this->count = $this->matchesOverview();
    }

    public function render()
    {
        return view('livewire.alert.index');
    }
}
