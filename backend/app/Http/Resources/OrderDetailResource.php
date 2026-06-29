<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderDetailResource extends JsonResource
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
            'id' => $this->id,
            'product_id' => $this->product_id,
            'order_id' => $this->order_id,
            'quantity' => $this->quantity,
            'product_price' => $this->product_price,
            'created_at' => $this->created_at
            ? Carbon::parse($this->created_at)->format('Y/m/d H:i:s')
            : null,
            'updated_at' => $this->updated_at,
            'product' =>new ProductResource(
                $this->whenLoaded('product')
            ),
            'order' =>new OrderResource(
                $this->whenLoaded('order')
            ),
        ];
    }
}
