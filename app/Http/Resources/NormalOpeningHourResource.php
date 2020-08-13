<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NormalOpeningHourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'day_of_week' => $this->day_of_week,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time
        ];
    }
}
