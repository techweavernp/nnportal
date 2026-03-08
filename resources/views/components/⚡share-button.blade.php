<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component {
    public Post $post;
    public int $shareCount;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->shareCount = $this->post->shares_count;
    }

    public function trackShare(): void
    {
        // Prevent duplicate clicks in same session
        if (session()->has("shared_{$this->post->id}")) {
            return;
        }

        $this->post->increment('shares_count');
        $this->shareCount++;
        session(["shared_{$this->post->id}" => true]);
    }
};
?>

<div class="share-buttons">
    <span class="article-shares">
        <span wire:text="shareCount" style="font-weight: 600;font-size:1.5rem"></span> Shares
    </span>
    <button class="share-btn facebook" wire:click="trackShare"
            onclick="shareOnFacebook(window.location.href, '{{$post->title}}')"
            aria-label="Share on Facebook">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
    </button>
    <button class="share-btn twitter"
            onclick="shareOnTwitter(window.location.href, '{{$post->title}}')"
            aria-label="Share on X">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.92 21.75H1.612l7.523-8.616L1.612 2.25H8.24l4.628 6.082z"/>
        </svg>
    </button>
    <button class="share-btn whatsapp"
            onclick="shareOnWhatsApp(window.location.href, '{{$post->title}}')"
            aria-label="Share on WhatsApp">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </button>
    <button class="share-btn messenger" aria-label="Share on Messenger">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M12 0C5.373 0 0 4.975 0 11.111c0 3.497 1.744 6.616 4.472 8.652V24l4.086-2.242c1.09.301 2.246.464 3.442.464 6.627 0 12-4.975 12-11.111C24 4.975 18.627 0 12 0zm1.193 14.963l-3.056-3.26-5.963 3.26 6.559-6.963 3.13 3.26 5.889-3.26-6.559 6.963z"/>
        </svg>
    </button>
</div>
