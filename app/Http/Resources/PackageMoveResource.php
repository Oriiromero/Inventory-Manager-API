<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageMoveResource extends JsonResource
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
            'status' => $this->status,
            'location' => $this->location,
            'packageId' => $this->package_id,
            'userId' => $this->handled_by,
            'packageInfo' => new PackageResource($this->whenLoaded('package')),
            'handledBy' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
