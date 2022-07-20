<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pattern',
        'search_id',
        'sensor_id',
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function search()
    {
        return $this->belongsTo(Search::class);
    }
}
