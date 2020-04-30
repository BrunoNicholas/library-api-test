<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Book extends Resource
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
            'title'     => $this->title,
            'original'  => $this->original_title,
            'year'      => $this->publication_year ? $this->publication_year : 'unknown',
            'isbn'      => $this->isbn,
            'language'  => $this->language_code,
            'image'     => $this->image ? $this->image : 'unknown',
            'thumbnail' => $this->thumbnail ? $this->thumbnail : 'unknown',
            'average_rating'    => $this->average_rating ? $this->average_rating : 'unknown',
            'total_ratings'     => $this->total_ratings ? $this->total_ratings : 'unknown',
            'updated'   => explode(' ', trim($this->updated_at)),
            'added'     => explode(' ', trim($this->created_at)),
        ];
    }
}
