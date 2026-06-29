<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'created_at' => $this->created_at
            ? Carbon::parse($this->created_at)->format('Y/m/d H:i:s')
            : null,
        ];
    }
}
