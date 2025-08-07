<?php

namespace App\Http\Resources;

use App\Traits\Resources\Unwrappable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin BackedEnum
 */
class EnumResource extends JsonResource
{
    use Unwrappable;

    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
