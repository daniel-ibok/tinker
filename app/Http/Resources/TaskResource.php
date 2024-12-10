<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'email' => $this->email,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
