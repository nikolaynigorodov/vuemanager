<?php

namespace App\Http\Resources;

use App\Helpers\StatusHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => StatusHelper::getStatus($this->status),
            'end_date' => $this->end_date,
            'subtasks' => ApiSubtaskResource::collection($this->subtasks)
        ];
    }
}
