<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $startDateTime = new \DateTime($this->start);
        $endDateTime = new \DateTime($this->end);

        $isStartOfDay = $startDateTime->format('H:i:s') === '00:00:00';
        $isEndOfDay = $endDateTime->format('H:i:s') === '00:00:00';

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end,
            'user' => [
                'name' => $this->user['name'],
                'id' => $this->user['id']
            ],
            'allDay' => $isStartOfDay && $isEndOfDay
        ];
    }
}
