<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCreator
{
    public static function bootHasCreator(): void
    {
        static::creating(function ($model) {
            $attribute = $model->creatorAttribute();

            if (empty($model->{$attribute})) {
                $model->{$attribute} = auth()->id();
            }
        });
    }

    /**
     * Relationship Methods
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, $this->creatorAttribute(), 'id');
    }

    /**
     * Unsorted Methods
     */
    public function creatorAttribute(): string
    {
        return 'creator_id';
    }

    public function isCreatedBy(User $user): bool
    {
        return $this->{$this->creatorAttribute()} == $user->id;
    }
}
