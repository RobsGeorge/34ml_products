<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'price' => $this->price,
            'stock' => $this->stock,
            'is_in_stock' => $this->is_in_stock,
        ];
    }
}