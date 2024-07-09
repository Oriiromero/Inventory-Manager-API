<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'trackingNumber' => $this->tracking_number,
            'description' => $this->description,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'status' => $this->status,
            'supermarkets' => new SupermarketResource($this->whenLoaded('supermarket')),
        ];
    }
}
