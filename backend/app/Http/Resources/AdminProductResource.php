<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\CategoryResource;

class AdminProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            "category_name" =>  $this->whenLoaded('category', fn() => $this->category->name),
            'release_date' => $this->release_date,
            'text' => $this->text,
            'stock' => $this->stock,
            'product_images' => ProductImageResource::collection($this->whenLoaded('product_images')),
            "created_at" => $this->created_at?->timezone('Asia/Tokyo')->format('Y-m-d H:i:s'),
            "updated_at" => $this->updated_at?->timezone('Asia/Tokyo')->format('Y-m-d H:i:s'),
        ];
    }
}
