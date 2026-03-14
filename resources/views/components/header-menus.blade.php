<!-- Header -->
<header class="header">
    <div class="container header-inner">
        <a href="/" class="logo">
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo">
        </a>

        <nav class="nav">
            <a href="/" class="nav-link {!! request()->is('index')||request()->is('/')?'active':'' !!}">गृहपृष्ठ</a>
            @foreach($menuCategories as $category)
                <a href="{{"/category/".$category->slug}}" class="nav-link {!! request()->is("category/$category->slug")?'active':'' !!}">{{$category->name}}</a>
            @endforeach
        </nav>

        <button class="menu-btn" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div>
<div class="mobile-menu">
    <button class="mobile-menu-close">&times;</button>
    <nav class="mobile-nav">
        @foreach($menuCategories as $category)
            <a href="{{"/category/".$category->slug}}" class="mobile-nav-link">{{$category->name}}</a>
        @endforeach
            <a href="{{"/category/technology"}}" class="mobile-nav-link">टेक्नोलोजी</a>
    </nav>
</div>
