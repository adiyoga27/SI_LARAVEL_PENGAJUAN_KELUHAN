<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionResource extends JsonResource
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
            'task_number' => $this->task_number,
            'user_id' => $this->user_id,
            'nik' => $this->nik,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'complaint_village' => $this->complaint_village,
            'hp' => $this->hp,
            'latitude' => $this->latitude,
            'longtitude' => $this->longtitude,
            'status' => $this->status,

            'images' => SubmissionImageResource::collection($this->images),
        ];
    }
}
