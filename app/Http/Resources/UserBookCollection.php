<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\Book;
use App\User;

class UserBookCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user'  => $this->user_id ? User::where('id',$this->user_id)->first()->name : 'unknown',
            'book'  => $this->book_id ? Book::where('id',$this->book_id)->first()->title : 'unknown',
            'added'     => explode(' ', trim($this->created_at)),
            'details'  => route('userbooks.show', $this->id)
        ];
    }
}
