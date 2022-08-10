<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'costValue' => $this->when($request->has('costValue'), $this->costValue),
            'potentialNet' => $this->when($request->has('potentialNet'), $this->potentialNet),
            'potentialProfit' => $this->when($request->has('potentialProfit'), $this->potentialProfit),
            'created' => $this->created_at,
            'items' => ItemResource::collection($this->whenLoaded('items'))
        ];
    }
}
