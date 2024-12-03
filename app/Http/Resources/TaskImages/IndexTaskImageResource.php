<?php

namespace App\Http\Resources\TaskImages;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexTaskImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'file_name'  => $this->file_name,
            'type'       => $this->type,
        ];
    }
}
