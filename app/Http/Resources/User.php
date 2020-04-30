<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
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
            'name'      => $this->name,
            'email'     => $this->email,
            'joined'    => explode(' ', trim($this->created_at)),
            'updated'   => explode(' ', trim($this->updated_at)),
        ];
    }
}
