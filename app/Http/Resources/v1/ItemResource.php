<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'storeId' => $this->store_id,
            'fullName' => $this->full_name,
            'itemCode' => $this->item_code,
            'quantity' => $this->quantity,
            'purchasePrice' => $this->purchase_price,
            'markup' => $this->markup,
            'created' => $this->created_at
        ];
    }
}
