<x-layout>

    <x-header-menus :menuCategories="$menuCategories" />

    <!-- Top Banner Ad -->
    {{--<div class="container">
        <div class="ad-space ad-top">
            <a href="https://your-ad-link.com" target="_blank">
                <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement">
            </a>
        </div>
    </div>--}}

    <!-- Category Header -->
    <section class="category-header">
        <div class="container">
            <h1 class="category-title reveal">{{$categoryName}}</h1>
            <div class="category-title-line"></div>
        </div>
    </section>

    <!-- Main Layout -->
    <div class="container">
        <div class="main-layout">
            <!-- Main Content -->
            <main>
                <!-- Featured News -->
                @if($featuredPost)
                <article class="hero-card reveal mb-3">
                    <a href="{{ route('post.show', $featuredPost->slug) }}" class="hero-image">
                        <img src="{{ $featuredPost->featured_image ? asset('storage/' . $featuredPost->featured_image) : asset('assets/images/icon.png') }}" alt="Featured News">
                    </a>
                    <div class="hero-content">
                        <a href="{{ route('post.show', $featuredPost->slug) }}">
                            <h2 class="hero-title">{{$featuredPost->title}}</h2>
                        </a>
                        <div class="hero-meta">
                            <span class="hero-author">
                                <img src="{{asset('assets/images/icon.png')}}" alt="Author">
                                {{$featuredPost->author->nick_name}}
                            </span>
                            <span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                {{$featuredPost->published_at_human}}</span>
                        </div>
                        <p class="hero-excerpt">
                            {{$featuredPost->excerpt}}
                        </p>
                        <a href="{{ route('post.show', $featuredPost->slug) }}" class="read-more">
                            विस्तृतमा पढ्नुहोस्
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
                @endif

                <!-- Inline Ad -->
                {{--<div class="ad-space ad-inline">
                    <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/02/1200X100px.jpg"
                         alt="Advertisement 1200x100px">
                </div>--}}

                <!-- News Grid -->
                <div class="category-grid">
                    @foreach($newsLists as $post)
                    <article class="news-card reveal stagger-1">
                        <a href="{{ route('post.show', $post->slug) }}" class="news-image">
                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/icon.png') }}" alt="nepal news postal">
                        </a>
                        <div class="news-content">
                            <a href="{{ route('post.show', $post->slug) }}">
                                <h3 class="news-title">{{$post->title}}</h3>
                            </a>
                            <div class="news-meta">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>{{$post->published_at_human}}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </main>

            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Sidebar Ad -->
                {{--<div class="ad-space ad-sidebar reveal">
                    <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/02/WhatsApp-Image-2026-02-02-at-09.46.17.jpeg"
                         alt="images" />
                </div>--}}

                <!-- Popular News -->
                <section class="popular-section reveal">
                    <div class="section-header">
                        <h2 class="section-title">लोकप्रिय...</h2>
                        <div class="section-line"></div>
                    </div>

                    <livewire:lokapriya />
                </section>

                <!-- Another Sidebar Ad -->
                {{--<div class="ad-space ad-sidebar reveal">
                    <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/02/WhatsApp-Image-2026-02-02-at-09.46.17.jpeg"
                         alt="images" />
                </div>--}}
            </aside>
        </div>
    </div>

    <!-- Bottom Banner Ad -->
    {{--<div class="container">
        <div class="ad-space ad-top">
            <!-- Replace the span with an anchor and image tag -->
            <a href="https://your-ad-link.com" target="_blank">
                <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement 1200x90">
            </a>
        </div>
    </div>--}}

</x-layout>
