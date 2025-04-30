<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'is_in_stock' => $this->is_in_stock,
            'average_rating' => $this->average_rating,
            'options' => OptionResource::collection($this->options),
            'default_variant' => new VariantResource($this->defaultVariant),
        ];
    }
}