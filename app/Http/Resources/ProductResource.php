<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'      => $this->title,
            'status'     => $this->status,
            'image'      => $this->getFirstMediaUrl('product_images'),
            'features'   => $this->features, 
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
