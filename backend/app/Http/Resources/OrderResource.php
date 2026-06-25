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
            'user' => [
                'name'=>$this->user->name,
                'email'=>$this->user->email,
                'tel'=>$this->user->tel,
                'postal'=>$this->user->postal,
                'address'=>$this->user->address,
            ]
            // 'products'=>$this->order_details->map(function($detail){

            // })
        ];
    }
}
