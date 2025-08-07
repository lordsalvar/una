<?php

namespace App\Http\Resources\Misc;

use App\Traits\Resources\Unwrappable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateTimeResource extends JsonResource
{
    use Unwrappable;

    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'human' => $this->diffForHumans(),
            'date' => $this->format('M j, Y'),
            'time' => $this->format('h:ia'),
            'date_time' => $this->toDateTimeString(),
            'date_time_format' => $this->format('M j, Y h:ia'),
            'date_value' => $this->format('Y-m-d'),
            'time_value' => $this->format('H:i'),
        ];
    }
}
