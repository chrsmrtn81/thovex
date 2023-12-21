<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    // Scope Queries

    public function scopeCreatePoint($query, $latitude, $longitude)
    {
        return $query->create([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
