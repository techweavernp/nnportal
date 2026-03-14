<x-layout :post="$post">
    <x-header-menus :menuCategories="$menuCategories" />
<!-- Top Banner Ad -->
{{--<div class="container">
    <div class="ad-space ad-top">
        <a href="https://your-ad-link.com" target="_blank">
            <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement">
        </a>
    </div>
</div>--}}

<!-- Article Header -->
<header class="article-header">
    <div class="container">
        <h1 class="article-title reveal">{{$post->title}}</h1>

        <div class="article-meta-bar reveal stagger-1">
            <div class="article-meta">
                    <span class="article-author">
                        <img src="{{asset('assets/images/icon.png')}}" alt="logo">
                        {{$post->author->nick_name}}
                    </span>
                <span class="article-date">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        {{$post->published_at_human}}
                    </span>
            </div>

            <!-- Social Share Buttons -->
            <livewire:share-button :post="$post"/>
        </div>
    </div>
</header>

<!-- Main Layout -->
<div class="container">
    <div class="main-layout">
        <!-- Article Content -->
        <article>
            <!-- Featured Image -->
            @if($post->featured_image)
            <div class="article-image reveal">
                <img src="{{  asset('storage/' . $post->featured_image) }}" alt="nepal news portal">
            </div>
            @endif

            <!-- Article Body -->
            <div class="article-content reveal stagger-1">
                {!! $post->content !!}
            </div>

            {{-- Inline Ad --}}
            {{--<div class="ad-space ad-inline reveal">
                <a href="https://your-ad-link.com" target="_blank">
                    <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/02/1200X100px.jpg"
                         alt="Advertisement">
                </a>
            </div>--}}

            <!-- Related News -->
            <section class="related-section">
                <div class="section-header reveal">
                    <h2 class="section-title">अन्य समाचार</h2>
                    <div class="section-line"></div>
                </div>

                <div class="related-grid">
                    @foreach($latestPosts as $post)
                    <article class="news-card reveal stagger-1">
                        <a href="{{route('post.show', $post->slug)}}" class="news-image">
                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/icon.png') }}" alt="nepal news portal">
                        </a>
                        <div class="news-content">
                            <a href="{{route('post.show', $post->slug)}}">
                                <h3 class="news-title">{{$post->title}}</h3>
                            </a>
                            <div class="news-meta">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>{{$post->published_at_human}}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach

                </div>
            </section>
        </article>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Sidebar Ad -->
            {{--<div class="ad-space ad-sidebar reveal">
                <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/02/WhatsApp-Image-2026-02-02-at-09.46.17.jpeg"
                     alt="advertisement" />
            </div>--}}

            <!-- Recent News (भर्खरै...) -->
            <section class="recent-section reveal">
                <div class="section-header">
                    <h2 class="section-title">लोकप्रिय...</h2>
                    <div class="section-line"></div>
                </div>

                <livewire:lokapriya />
            </section>

            <!-- Another Sidebar Ad -->
            {{--<div class="ad-space ad-sidebar reveal">
                <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/02/WhatsApp-Image-2026-02-02-at-09.46.17.jpeg"
                     alt="advertisement" />
            </div>--}}

            <!-- Kalimati Market Price -->
            <x-kalimati-market-price />
        </aside>
    </div>

    <!-- Trending News Section (Full Width Bottom) -->
    <section class="trending-section reveal">
        <div class="section-header">
            <h2 class="section-title">ट्रेन्डिङ</h2>
            <div class="section-line"></div>
        </div>

        <div class="trending-grid">
            @foreach($trendingPosts as $post)
            <a href="{{route('post.show', $post->slug)}}" class="trending-item">
                <div class="trending-thumb-container">
                    <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/icon.png') }}" alt="nepal news portal">
                    <span class="trending-number">{{ \App\Helpers\NepaliDateConvertor::toNepaliDigits($loop->iteration) }}</span>
                </div>
                <span class="trending-title">{{$post->title}}</span>
            </a>
            @endforeach
        </div>
    </section>
</div>

<!-- Bottom Banner Ad -->
{{--<div class="container">
    <div class="ad-space ad-bottom">
        <a href="https://your-ad-link.com" target="_blank">
            <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement 1200x90">
        </a>
    </div>
</div>--}}

</x-layout>
