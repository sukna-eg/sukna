<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'answer'=> $this->answer,
            'question_id'=> $this->question?->id,
            'question'=> $this->question?->question,
            'user'=>new UserResource($this?->user),
            // 'user_id'=> $this->user?->id,
            // 'question'=> $this->question?->question,

        ];
    }
}
