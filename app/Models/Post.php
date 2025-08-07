<?php

namespace App\Models;

use App\Enums\PostType;
use App\Traits\HasCreator;
use App\Traits\HasUlid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasCreator;
    use HasUlid;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'type',
        'is_exclusive',
    ];

    protected $casts = [
        'type' => PostType::class,
        'is_exclusive' => 'boolean',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
