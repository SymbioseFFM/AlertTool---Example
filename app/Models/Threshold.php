<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threshold extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'sensor_id',
        'currentTime',
        'last_match',
        'progressed',
        'threshold',
        'state',
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
