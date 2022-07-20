<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'subject',
        'content',
        'content_stripped',
        'progressed',
        'received_date',
    ];

    public function sensors()
    {
        return $this->belongsToMany(Sensor::class);
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class);
    }
}
