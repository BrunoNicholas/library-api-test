<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'original_title',
        'publication_year',
        'isbn',
        'language_code',
        'image',
        'thumbnail',
        'average_rating',
        'total_ratings'
    ];

    /**
     * The string variable is for the table.
     *
     * @var array
     */
    protected $table = 'books';
}
