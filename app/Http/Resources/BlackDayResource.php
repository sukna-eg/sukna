<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlackDayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'=>$this->id,
            'from'=> $this->from,
            'to'=> $this->to,
            'partner_id'=> $this->partner?->id,
            'user'=> new UserResource($this?->user),
            'appointment_id'=> $this->appointment?->id,



        ];
    }
}
