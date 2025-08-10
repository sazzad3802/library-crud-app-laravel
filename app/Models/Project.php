<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'start_date',
        'program',
        'type',
        'donor',
        'lifetime',
        'running',
        'fund_proposed',
    ];
}
