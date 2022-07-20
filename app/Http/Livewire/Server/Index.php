<?php

namespace App\Http\Livewire\Server;

use Livewire\Component;

use App\Models\Server;
use App\Models\Customer;
use App\Models\Location;

use App\Traits\WithModal;


class Index extends Component
{
    use WithModal;

    public $servers;
    public $customers;
    public $locations;
    public $s;

    protected $listeners = ['refreshIndex' => '$refresh'];

    protected function rules()
    {
        $this->s ? $id = ",{$this->s->id}" : $id = "";

        return [
            's.name' => "max:255|unique:servers,name{$id}|required",
            's.ip' => ['max:255', 'regex:/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/'],
            's.os' => 'max:255',
            's.backup_software' => 'max:255',
            's.customer_id' => 'required|integer',
            's.location_id' => 'required|integer',
            's.created_at' => '',
            's.updated_at' => '',
        ];
    }

    public function render()
    {
        $this->servers = Server::orderBy('id', 'DESC')->get();
        $this->customers = Customer::get();
        $this->locations = Location::get();
        return view('livewire.server.index');
    }

    public function createModal()
    {
        $this->s = Server::make();

        $this->modal('show', '#create');
    }

    public function create()
    {
        $this->s->name = trim($this->s->name);
        $this->s->ip = trim($this->s->ip);
        $this->s->os = trim($this->s->os);
        $this->s->backup_software = trim($this->s->backup_software);

        $this->validate();
        $this->s->save();

        $this->modal('hide', '#create');
        $this->emit('refreshIndex');
    }

    public function editModal($id)
    {
        $this->s = Server::find($id) ?? NULL;

        if($this->s){
            $this->modal('show', '#edit');
        }
    }

    public function edit()
    {
        $this->s->name = trim($this->s->name);
        $this->s->ip = trim($this->s->ip);
        $this->s->os = trim($this->s->os);
        $this->s->backup_software = trim($this->s->backup_software);

        $this->validate();
        $this->s->save();

        $this->modal('hide', '#edit');
        $this->emit('refreshIndex');
    }

    public function deleteModal($id)
    {
        $this->s = Server::find($id);

        if($this->s){
            $this->modal('show', '#delete');
        }
    }

    public function delete()
    {
        $this->s ? $this->s->delete() : NULL;

        $this->modal('hide', '#delete');
        $this->emit('refreshIndex');
    }

}
