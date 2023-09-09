<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\Favorite;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $fav = false;
        if(Auth::user()){
        $favorite = Favorite::where('user_id',Auth::user()->id)->where('partner_id',$this->id)->first();
            if($favorite){
                $fav = true ;
            }
        }



        return [

            'id' => $this->id,
            'is_favorite'=>$fav,
            'address' => $this->address,
            'description' => $this->description,
            'type' => $this->type,
            'show' => $this->show,
            'space' => $this->space,
            'bedrooms_count' => $this->bedrooms_count,
            'bathrooms_count' => $this->bathrooms_count,
            'cladding' => $this->cladding,
            'floor' => $this->floor,
            'furnished' => $this->furnished,
            'lat' => $this->lat,
            'long' => $this->long,
            'elevator' => $this->elevator,
            'status' => $this->status,
            'order' => $this->order,
            'premium' => $this->premium,
            'min' => $this->min,
            'max' => $this->max,
            'period' => $this->period,
            'views' => $this->views,
            'video_url' => $this->video_url,
            'music' => $this->music,
            'from' => $this->from,
            'to' => $this->to,
            'direction' => $this->direction,
            'Property' => $this->Property,
            'purpose' => $this->purpose,
            'price' => $this->price,
            'is_smart' => $this->is_smart,
            'subcategory_id'=> $this->subcategory?->id,
            'subcategory_name'=> $this->subcategory?->name,
            'created_at'=> $this->created_at,
            'area'=> $this->area?->name,
            'city'=> $this->area?->city?->name,
            'user'=> new UserResource($this?->user),

            'rating'=>(double)$this?->reviews?->avg('points'),
            'rating_count'=>(double)$this?->reviews?->count(),
            'black_days' => BlackDayResource::collection($this?->blacks),
            'images' => PimageResource::collection($this?->images),
        ];
    }
}
