<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\Book;
use App\User;

class UserBook extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id_number' => $this->id,
            'user'      => $this->user_id ? User::where('id',$this->user_id)->first()->name : 'unknown',
            'user_email'=> $this->user_id ? User::where('id',$this->user_id)->first()->email : 'unknown',
            'book'      => $this->book_id ? Book::where('id',$this->book_id)->first()->title : 'unknown',
            'book_image'=> $this->book_id ? Book::where('id',$this->book_id)->first()->image : 'unknown',
            'time_due'  => $this->due_at ? $this->due_at : 'unknown',
            'date_returned' => $this->returned_at ? $this->returned_at : 'unknown',
            'updated'   => explode(' ', trim($this->updated_at)),
            'added'     => explode(' ', trim($this->created_at)),
        ];
    }
}
