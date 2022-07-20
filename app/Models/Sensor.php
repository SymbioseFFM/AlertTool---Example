<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'server_id',
        'device_id',
        'warning_threshold',
        'threshold',
        'last_match',
        'warning'
    ];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function pattern()
    {
        return $this->hasOne(PatternSensor::class);
    }

    public function identifiers()
    {
        return $this->hasMany(Identifier::class);
    }

    public function thresholds()
    {
        return $this->hasMany(Threshold::class);
    }

    public function alerts()
    {
        return $this->belongsToMany(Alert::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
