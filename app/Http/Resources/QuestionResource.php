<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'question'=> $this->question,
            'status'=> $this->status,
            'created_at'=> $this->created_at,
            // 'user_id'=> $this->user?->id,
            'user'=>new UserResource($this?->user),
            'answers'=> AnswerResource::collection($this?->answers),



        ];
    }
}
