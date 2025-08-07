<?php

namespace App\Http\Resources;

use App\Http\Resources\Enums\PostTypeResource;
use App\Http\Resources\Misc\DateTimeResource;
use App\Traits\Resources\Unwrappable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    use Unwrappable;

    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ulid,
            'title' => $this->title,
            'content' => $this->content,
            'type' => PostTypeResource::make($this->type),
            'is_exclusive' => $this->is_exclusive,
            'creator' => CreatorResource::make($this->whenLoaded('creator')),
            'created_at' => DateTimeResource::make($this->created_at),
            'updated_at' => DateTimeResource::make($this->updated_at),
        ];
    }
}
