<?php

namespace App\Http\Resources\Tasks;

use App\Http\Resources\TaskImages\IndexTaskImageResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => $this->status,
            'created_at'  => Carbon::parse($this->created_at)->diffForHumans(),
            'taskImages'  => IndexTaskImageResource::collection($this->whenLoaded('taskImages'))
        ];
    }
}
