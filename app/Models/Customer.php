<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'user_id',
        'number',
        'email',
        'instance_id',
    ];

    public function servers()
    {
        return $this->hasMany(Server::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
}
