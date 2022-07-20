<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatternSensor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pattern_sensor';

    protected $fillable = [
        'sensor_id',
        'success',
        'warning',
        'error',
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
