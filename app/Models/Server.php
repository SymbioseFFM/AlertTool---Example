<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customer_id',
        'location_id',
        'ip',
        'os',
        'backup_software'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
