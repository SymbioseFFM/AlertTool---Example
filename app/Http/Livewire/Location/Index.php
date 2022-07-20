<?php

namespace App\Http\Livewire\Location;

use Livewire\Component;
use App\Models\Location;
use App\Traits\WithModal;


class Index extends Component
{
    use WithModal;

    public $locations;
    public $l;
    
    protected $listeners = ['refreshIndex' => '$refresh'];

    protected function rules()
    {
        $this->l ? $id = ",{$this->l->id}" : $id = "";

        return [
            'l.name' => "max:255|unique:locations,name{$id}|required",
        ];
    }

    public function render()
    {
        $this->locations = Location::orderBy('id', 'ASC')->get();
        return view('livewire.location.index');
    }

    public function createModal()
    {
        $this->l = Location::make();

        $this->modal('show', '#create');
    }

    public function create()
    {
        $this->l->name = trim($this->l->name);
        $this->validate();
        $this->l->save();

        $this->modal('hide', '#create');
        $this->emit('refreshIndex');
    }

    public function editModal($id)
    {
        $this->l = Location::find($id) ?? NULL;

        if($this->l){
            $this->modal('show', '#edit');
        }
    }

    public function edit()
    {
        $this->l->name = trim($this->l->name);
        $this->validate();
        $this->l->save();

        $this->modal('hide', '#edit');
        $this->emit('refreshIndex');
    }

    public function deleteModal($id)
    {
        $this->l = Location::find($id);

        if($this->l){
            $this->modal('show', '#delete');
        }
    }

    public function delete()
    {
        $this->l ? $this->l->delete() : NULL;

        $this->modal('hide', '#delete');
        $this->emit('refreshIndex');
    }

}
