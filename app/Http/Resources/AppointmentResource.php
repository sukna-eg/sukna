<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            // 'question'=> $this->question?->question,
            'user_id'=> $this->user?->id,
            'user_phone'=> $this->user?->phone,
            'created_at'=> $this->created_at,
            // 'question'=> $this->question?->question,

        ];
    }
}
