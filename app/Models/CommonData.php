<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommonData extends Model
{
    /** @use HasFactory<\Database\Factories\StandingDataFactory> */
    use HasFactory;

    protected $table = 'common_data';

    protected $fillable = [
        'pid',
        'type',
        'name',
        'description',
        'is_active',
        'int_value',
        'string_value',
        'latitude',
        'longitude',
        'parent_id'
    ];
}
