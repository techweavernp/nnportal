<?php
namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver 
{
    public function created(Post $post): void
    {
        Cache::flush();
    }

    public function updated(Post $post): void
    {
        Cache::flush();
    }

    public function deleted(Post $post): void
    {
        Cache::flush();
    }

}