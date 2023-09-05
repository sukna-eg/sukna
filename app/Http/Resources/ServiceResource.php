<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'description' => $this->description,
            'address' => $this->address,
            'image' => $this->image,
            'logo' => $this->logo,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'premium' => $this->premium,
            'category_id'=> $this->category?->id,
            'category_name'=> $this->category?->name,
            'projects' => ProjectResource::collection($this?->projects),

            // 'images' => PimageResource::collection($this?->images),
        ];
    }
}
