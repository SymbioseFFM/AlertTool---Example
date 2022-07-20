<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'location_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function locations()
    {
        return $this->belongsTo(Location::class);
    }
}
