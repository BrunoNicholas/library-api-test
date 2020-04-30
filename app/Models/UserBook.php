<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'due_at',
        'returned_at'
    ];

    /**
     * The string variable is for the table.
     *
     * @var array
     */
    protected $table = 'user_books';
}
