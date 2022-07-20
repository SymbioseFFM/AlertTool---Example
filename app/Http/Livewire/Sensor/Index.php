<?php

namespace App\Http\Livewire\Sensor;

use Livewire\Component;

use App\Models\Sensor;
use App\Models\Server;
use App\Models\Customer;
use App\Models\Location;
use App\Models\PatternSensor;
use App\Models\Identifier;
use App\Models\Search;

use App\Traits\WithModal;


class Index extends Component
{
    use WithModal;

    public $sensors;
    public $servers;
    public $s;
    public $pattern;
    public $identifier;
    public $search;
    public $threshold;

    protected $listeners = ['refreshIndex' => '$refresh'];

    protected function rules()
    {
        $this->s ? $id = ",{$this->s->id}" : $id = "";

        return [
            's.name' => "max:255|unique:sensors,name{$id}|required",
            's.server_id' => 'required|integer',
            's.device_id' => 'required|integer',
            's.warning_threshold' => 'required|integer',
            's.threshold' => 'integer',
            's.warning' => 'integer',
            's.last_match' => 'integer',
            's.created_at' => '',
            'pattern.sensor_id' => '',
            'pattern.success' => '',
            'pattern.warning' => '',
            'pattern.error' => '',
            'identifier.sensor_id' => '',
            'identifier.pattern' => '',
            'search.id' => '',
            'search.name' => '',
        ];
    }

    public function render()
    {
        $this->sensors = Sensor::orderBy('id', 'ASC')->get();
        $this->servers = Server::orderBy('name', 'ASC')->get();

        return view('livewire.sensor.index');
    }

    public function createModal()
    {
        $this->s = Sensor::make();

        $this->modal('show', '#create');
    }

    public function create()
    {
        $this->s->name = trim($this->s->name);
        $this->s->warning = 0;

        $thresholdHasTime = true;

        if($this->threshold){
            $this->s->warning_threshold = 1;
            if($this->s->threshold){
                if($this->s->threshold > 0){
                    $thresholdHasTime = true;
                }else{
                    $thresholdHasTime = false;
                }
            }else{
                $thresholdHasTime = false;
            }
            $this->validate();
            $this->s->threshold = $this->s->threshold * 60;
            $this->s->last_match = time();
        }else{
            $this->s->warning_threshold = 0;
            $this->validate();
        }


        $thresholdHasTime ? $this->s->save() : NULL;

        $this->modal('hide', '#create');
        $this->emit('refreshIndex');
    }

    public function editModal($id)
    {
        $this->s = Sensor::find($id) ?? NULL;
        if($this->s->warning_threshold == 1){
            $this->threshold = true;
            $this->s->threshold = $this->s->threshold / 60;
        }else{
            $this->threshold = false;
        }

        if($this->s){
            $this->modal('show', '#edit');
        }
    }

    public function edit()
    {
        $this->s->name = trim($this->s->name);
        $this->validate();
        if($this->threshold){
            $this->s->warning_threshold = 1;
            $this->s->threshold = $this->s->threshold * 60;
            $this->s->last_match = time();
        }else{
            $this->s->warning_threshold = 0;
            $this->s->threshold = NULL;
        }

        $this->s->save();

        $this->modal('hide', '#edit');
        $this->emit('refreshIndex');
    }

    public function deleteModal($id)
    {
        $this->s = Sensor::find($id);

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

    public function patternModal($id)
    {
        $this->s = Sensor::find($id);

        if($this->s){
            $this->s->pattern ? $this->pattern = $this->s->pattern : $this->pattern = PatternSensor::make();
            if(count($this->s->identifiers) > 0){
                $this->search = $this->s->identifiers->first()->search;
                $this->identifier = $this->s->identifiers->first();
            }else{
                $this->search = Search::make();
                $this->identifier = Identifier::make();
            }

            $this->modal('show', '#pattern');
        }
    }

    public function pattern()
    {
        $this->pattern->sensor_id = $this->s->id;
        $this->identifier->sensor_id = $this->s->id;
        $this->identifier->search_id = $this->search->id;

        $this->validate([
            'pattern.sensor_id' => 'required',
            'pattern.success' => '',
            'pattern.warning' => '',
            'pattern.error' => '',
            'identifier.pattern' => 'required',
            'identifier.search_id' => 'required',
            'identifier.sensor_id' => 'required',
        ]);
        $this->validate();

        $this->pattern->save();
        $this->identifier->save();

        $this->pattern = NULL;
        $this->identifier = NULL;
        $this->search = NULL;
        
        $this->modal('hide', '#pattern');
        $this->emit('refreshIndex');
    }
}