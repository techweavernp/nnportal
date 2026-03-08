<x-layout>

    <x-header-menus :menuCategories="$menuCategories" />

    {{-- Top Banner Ad --}}
    {{--<div class="container">
        <div class="ad-space ad-top">
            <!-- Replace the span with an anchor and image tag -->
            <a href="https://your-ad-link.com" target="_blank">
                <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement">
            </a>
        </div>
    </div>--}}

    {{-- Election Result --}}
    {{-- <x-election-result :electionResults="$electionResults" /> --}}

    <!-- Hero Section - Redesigned with Title Above Image, Centered -->
    <section class="hero-section hero-centered">
        <div class="container">
            @foreach($bannerPosts as $post)
            <article class="hero-card reveal">
                <div class="hero-content-centered">
                    <a href="{{ route('post.show', $post->slug) }}">
                        <h1 class="hero-title-large">{{$post->title}}</h1>
                    </a>
                    <div class="hero-meta-centered">
                        <span class="hero-author">
                            <img src="{{asset('assets/images/icon.png')}}" alt="Author">
                            {{$post->author->name}}
                        </span>
                        <span class="meta-separator">|</span>
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg> {{$post->published_at_human}}</span>
                    </div>
                </div>
                @if($post->featured_image)
                <a href="/post/{{$post->slug}}">
                    <div class="hero-image-centered">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Nepal News Portal">
                    </div>
                </a>
                @endif
                <div class="hero-content-centered">
                    <p class="hero-excerpt-centered">
                        {{$post->excerpt}}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    <!-- Inline Ad -->
    {{--<div class="container">
        <div class="ad-space ad-top">
            <!-- Replace the span with an anchor and image tag -->
            <a href="https://your-ad-link.com" target="_blank">
                <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement">
            </a>
        </div>
    </div>--}}

    <!-- Main 3-Column Section: भर्खरै... | मुख्य समाचार | लोकप्रिय... -->
    <section class="three-column-section">
        <div class="container">
            <div class="three-column-grid">

                <!-- Left Column: भर्खरै... -->
                <div class="column-left reveal">
                    <div class="column-header">
                        <h2 class="column-title">भर्खरै...</h2>
                        <div class="column-line"></div>
                    </div>

                    <div class="recent-news-list">
                        @foreach($latestPosts as $post)
                        <article class="recent-news-item">
                            <a href="{{ route('post.show', $post->slug) }}" class="recent-news-thumb">
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     alt="recent news">
                            </a>
                            <div class="recent-news-content">
                                <a href="{{ route('post.show', $post->slug) }}">
                                    <h4 class="recent-news-title">{{$post->title}}</h4>
                                </a>
                                <span class="recent-news-meta">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    {{$post->published_at_human}}</span>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>

                <!-- Center Column: मुख्य समाचार -->
                <div class="column-center reveal stagger-1">
                    <div class="column-header">
                        <h2 class="column-title">मुख्य समाचार</h2>
                        <div class="column-line"></div>
                    </div>

                    <!-- Featured Main News -->
                    @if($featuredPost)
                        <article class="main-featured-news">
                            <a href="{{ route('post.show', $featuredPost->slug) }}" class="main-featured-image">
                                <img src="{{ $featuredPost->featured_image ? asset('storage/' . $featuredPost->featured_image) : asset('assets/images/icon.png') }}" alt="{{ $featuredPost->title }}">
                            </a>
                            <div class="main-featured-content">
                                <a href="{{ route('post.show', $featuredPost->slug) }}">
                                    <h3 class="main-featured-title">{{ $featuredPost->title }}</h3>
                                </a>
                            </div>
                        </article>
                    @endif

                    <!-- Main News List -->
                    <div class="main-news-list">
                        @foreach($mainNewsLists as $post)
                        <article class="main-news-item">
                            <a href="{{ route('post.show', $post->slug) }}" class="main-news-thumb">
                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/icon.png') }}" alt="main news">
                            </a>
                            <div class="main-news-item-content">
                                <a href="{{ route('post.show', $post->slug) }}">
                                    <h4 class="main-news-item-title">{{$post->title}}</h4>
                                </a>
                                <div class="main-news-item-meta">
                                    <span class="hero-author">
                                        <img src="{{asset('assets/images/icon.png')}}" alt="Author">
                                        {{$post->author->name}}
                                    </span>
                                    <span class="meta-dot"></span>
                                    <span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                        {{$post->published_at_human}}</span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: लोकप्रिय... -->
                <div class="column-right reveal stagger-2">
                    <div class="column-header">
                        <h2 class="column-title">लोकप्रिय...</h2>
                        <div class="column-line"></div>
                    </div>

                    <livewire:lokapriya />

                    <!-- Sidebar Ad -->
                    {{--<div class="ad-space ad-sidebar">
                        <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/01/online-300x200-1.gif"
                             alt="Advertisement">
                    </div>
                    <div class="ad-space ad-sidebar">
                        <img src="https://www.onlinekhabar.com/wp-content/uploads/2026/01/online-300x200-1.gif"
                             alt="Advertisement">
                    </div>--}}
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Banner Ad -->
    {{--<div class="container">
        <div class="ad-space ad-top">
            <!-- Replace the span with an anchor and image tag -->
            <a href="https://your-ad-link.com" target="_blank">
                <img src="{{asset('assets/images/ads/ad-banner.jpg')}}" alt="Advertisement">
            </a>
        </div>
    </div>--}}

    <!-- Photo Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="section-header reveal">
                <h2 class="section-title">Highlights</h2>
                <div class="section-line" style="background: rgba(255,255,255,0.3);"></div>
            </div>

            <div class="gallery-grid">
                <a href="news-detail.html" class="gallery-item reveal stagger-1">
                    <img src="https://nepalnewsportal.com/wp-content/uploads/2026/02/bom-bispot.jpg" alt="Gallery 1">
                    <div class="gallery-overlay">
                        <span class="gallery-title">कजाकिस्तानमा ग्यास विस्फोट, सात जनाको मृत्यु</span>
                    </div>
                </a>
                <a href="news-detail.html" class="gallery-item reveal stagger-2">
                    <img src="https://images.unsplash.com/photo-1520638023360-6def43369781?w=800&h=600&fit=crop"
                         alt="Gallery 2">
                    <div class="gallery-overlay">
                        <span class="gallery-title">आज शुक्रबार बिहान ४.७ रेक्टर स्केलको भूकम्प गएको छ।</span>
                    </div>
                </a>
                <a href="news-detail.html" class="gallery-item reveal stagger-3">
                    <img src="https://nepalnewsportal.com/wp-content/uploads/2026/02/Beige-Bold-Cricket-Match-Banner-8-1536x768.jpg"
                         alt="Gallery 3">
                    <div class="gallery-overlay">
                        <span class="gallery-title">होलीमा सार्वजनिक स्थानमा भेला र चुनावी प्रचारमा रोक</span>
                    </div>
                </a>
                <a href="news-detail.html" class="gallery-item reveal stagger-4">
                    <img src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=800&h=600&fit=crop"
                         alt="Gallery 4">
                    <div class="gallery-overlay">
                        <span class="gallery-title">रिडी लाइन इनर्जीको आईपीओ बाँडफाँट सम्पन्न</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Floating 3D Ad -->
    <div class="floating-ad-container" id="floatingAd">
        <div class="ad-close-btn" id="closeFloatingAd">&times;</div>
        <div class="cube-container">
            <div class="cube-face face-front">
                <img src="https://nepalnewsportal.com/wp-content/uploads/2026/02/NepalNewsPortal-GIF.gif" alt="Ad 1"
                     style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="cube-face face-back">
                <img src="https://nepalnewsportal.com/wp-content/uploads/2026/02/NewsNepa.gif" alt="Ad 2"
                     style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="cube-face face-left">
                <img src="https://nepalnewsportal.com/wp-content/uploads/2026/02/aD-sPACE.gif" alt="Ad 3"
                     style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="cube-face face-right">
                <img src="https://nepalnewsportal.com/wp-content/uploads/2026/02/techweaver.gif" alt="Ad 4"
                     style="width: 100px; height: 100px; object-fit: cover;">
            </div>
        </div>
        <div class="cube-shadow"></div>
    </div>

</x-layout>
