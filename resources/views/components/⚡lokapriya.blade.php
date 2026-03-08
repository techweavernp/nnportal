<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component {
    public $popularPosts;

    public function mount(): void
    {
        $this->popularPosts = Post::popularPosts();
    }
};
?>

<div class="popular-list">
    @foreach($popularPosts as $post)
        <div class="lokapriya-box">
        <a href="{{route('post.show', $post->slug)}}" class="popular-item">
            <span class="popular-number">{{ \App\Helpers\NepaliDateConvertor::toNepaliDigits($loop->iteration) }}</span>
            <span class="popular-title">{{$post->title}}</span>
        </a>
        </div>
    @endforeach
</div>
