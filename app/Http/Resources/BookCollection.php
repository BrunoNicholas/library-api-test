<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BookCollection extends Resource
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
            'title'     => $this->title,
            'year'      => $this->publication_year ? $this->publication_year : 'unknown',
            'image'     => $this->image ? $this->image : 'unknown',
            'total_ratings'     => $this->total_ratings ? $this->total_ratings : 'unknown',
            'added'     => explode(' ', trim($this->created_at)),
            'details'  => route('books.show', $this->id)
        ];
    }
}
