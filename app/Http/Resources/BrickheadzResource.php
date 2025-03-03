<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrickheadzResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'lego_id' => $this->lego_id,
            'name' => $this->name,
            'image' => $this->image,
            'release_date' => $this->release_date,
            'is_discontinued' => $this->is_discontinued,
        ];
    }
}

