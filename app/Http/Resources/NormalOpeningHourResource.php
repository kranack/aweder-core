<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'open_time' => Carbon::make($this->open_time)->format('H:i'),
            'close_time' => Carbon::make($this->close_time)->format('H:i'),
            'is_delivery_hours' => $this->is_delivery_hours
        ];
    }
}
