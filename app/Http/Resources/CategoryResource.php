<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'card_title' => $this->card_title,
            'card_body' => $this->card_body,
            'subcategories'=> SubcategoryResource::collection($this?->subcategories),
            'services'=> ServiceResource::collection($this?->services),
        ];
    }
}
