<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use Hasulid;
    use HasCreator;


    protected $fillable = [
        'model_type',
        'model_id',
        'path',
        'disk',
        'size',
        'description',
        'creator_id',
    ];

    protected function casts(): array{
        return[
            'size' => 'integer',
        ];
    }

    public function model(): MorphTo{
        return $this->morphTo('model');
    }

    protected function filename(): Attribute{
        return Attribute::make(
            get: function ($value, $attributes){
                return $attributes['path']
                ? Str::of($attributes['path'])->afterLast('/')
                : null;
            }
        );
    }
}
