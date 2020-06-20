<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLocationResource extends JsonResource
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
            "id"=> $this->id,
            "profile_image"=> $this->profile_image,
            "lat"=> $this->lat,
            "lng"=> $this->lng,
            "name"=> $this->name,
        ];        }
}
