<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use App\Traits\WithModal;

class Index extends Component
{
    use WithModal;

    public $customers;
    public $c;
    
    protected $listeners = ['refreshIndex' => '$refresh'];

    protected function rules()
    {
        $this->c ? $id = ",{$this->c->id}" : $id = "";

        return [
            'c.name' => "required|max:255|unique:customers,name{$id}",
            'c.domain' => 'required|max:255|regex:/^(?!\-)(?:(?:[a-zA-Z\d][a-zA-Z\d\-]{0,61})?[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/',
            'c.email' => 'required|email',
            'c.number' => 'required|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/',
            'c.created_at' => '',
            'c.updated_at' => '',
        ];
    }

    public function render()
    {
        $this->customers = Customer::orderBy('name', 'ASC')->get();
        
        return view('livewire.customer.index');
    }

    public function createModal()
    {
        $this->c = Customer::make();

        $this->modal('show', '#create');
    }

    public function create()
    {
        $this->c->name = trim($this->c->name);
        $this->validate();
        $this->c->save();

        $this->modal('hide', '#create');
        $this->emit('refreshIndex');
    }

    public function editModal($id)
    {
        $this->c = Customer::find($id) ?? NULL;

        if($this->c){
            $this->modal('show', '#edit');
        }
    }

    public function edit()
    {
        $this->c->name = trim($this->c->name);
        $this->c->email = trim($this->c->email);
        $this->c->domain = trim($this->c->domain);
        $this->c->number = trim($this->c->number);

        $this->validate();
        $this->c->save();

        $this->modal('hide', '#edit');
        $this->emit('refreshIndex');
    }

    public function deleteModal($id)
    {
        $this->c = Customer::find($id);

        if($this->c){
            $this->modal('show', '#delete');
        }
    }

    public function delete()
    {
        $this->c ? $this->c->delete() : NULL;

        $this->modal('hide', '#delete');
        $this->emit('refreshIndex');
    }
}
