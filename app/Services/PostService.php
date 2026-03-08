<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public static function postQuery(?string $categorySlug = null)
    {
        return Post::with('author:id,name,nick_name')
            ->published()
            ->when($categorySlug, fn ($q) => $q->inCategory($categorySlug))
            ->orderByDesc('published_at')
            ->orderByDesc('id');

    }
}
