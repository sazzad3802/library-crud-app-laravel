<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Book extends Model
{
    // Optional: Allow mass assignment for these fields
    protected $fillable = [
        'bookId', 'title', 'author', 'genre', 'publisher',
        'description', 'rating', 'year', 'thumbnail'
    ];

    // Optional: Cast 'rating' to float, 'year' to Carbon date
    protected $casts = [
        'rating' => 'integer',
        'year' => 'date',
    ];

    // Optional: Custom method to get formatted title
    public function getFormattedTitle()
    {
        return "Book: " . $this->title;
    }
}
