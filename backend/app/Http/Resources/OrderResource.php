<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'order_id' => $this->id,
            'pay_method' => $this->pay_method,
            'total_price' => $this->total_price,
            'user' => new UserResource(
                $this->whenLoaded('user')
            ),
            'order_details' 
            => OrderDetailResource::collection( $this->whenLoaded('order_details') ),
        ];
    }
}
