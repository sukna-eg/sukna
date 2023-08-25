<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = today()->format('Y-m-d');
        return [

            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => (string)$this->phone,
            'lat'=> $this?->lat,
            'long'=> $this?->long,
            'image'=> $this?->image,
            'type'=> $this?->type,
            'active'=> $this?->active,
        ];
    }
}
