<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brickheadz' => new BrickheadzResource($this->brickheadz),
            'date_acquired' => $this->date_acquired,
            'price_acquired' => $this->price_acquired,
            'status' => $this->status,
        ];
    }
}

