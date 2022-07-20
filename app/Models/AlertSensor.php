<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertSensor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'alert_sensor';

    protected $fillable = [
        'sensor_id',
        'alert_id',
        'status_id',
        'progressed',
        'timestamp',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
