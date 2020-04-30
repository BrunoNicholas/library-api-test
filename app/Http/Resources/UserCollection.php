<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserCollection extends Resource
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
            'name'  => $this->name,
            'email' => $this->email,
            'details'  => route('users.show', $this->id),
            'joined'    => explode(' ', trim($this->created_at)),
        ];
    }
}
