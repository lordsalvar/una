<?php

namespace App\Enums;

enum PostType: string
{
    case Memo = 'memo';
    case Article = 'article';
    case News = 'news';
    case Blog = 'blog';

    public function label(): string
    {
        return match ($this) {
            default => $this->name,
        };
    }
}
