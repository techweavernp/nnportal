<!DOCTYPE html>
<html lang="ne">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>नेपाल न्युज पोर्टल</title>
    <meta name="description" content="Nepal News Portal, Nepal's fastest-growing news platform. Real stories, real impact.">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />

    @if(isset($post))
        <link rel="canonical" href="https://nepalnewsportal.com/post/{{trim($post->slug)}}" />

        <!-- Facebook OG Tags -->
        <meta property="og:title" content="{{$post->title}}" />
        <meta property="og:url" content="https://www.nepalnewsportal.com/post/{{trim($post->slug)}}" />
        <meta property="og:description" content="{!! $post->excerpt !!}" />
        <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}" />
        <!-- Facebook OG Tags -->
    @else
        <link rel="canonical" href="https://nepalnewsportal.com" />
        <meta property="og:title" content="नेपाल न्युज पोर्टल" />
        <meta property="og:url" content="https://nepalnewsportal.com" />
        <meta property="og:description" content="Nepal News Portal, Nepal's fastest-growing news platform. Real stories, real impact." />
        <meta property="og:image" content="https://nepalnewsportal.com/public/assets/images/icon.png" />
    @endif
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="नेपाल न्युज पोर्टल" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2TJ14RQ5FW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2TJ14RQ5FW');
    </script>

    <!-- Google Fonts - Anek Devanagari -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{asset('assets/images/icon.png')}}">
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M954ZNNS"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

{{$slot}}

<x-footer/>

<!-- JavaScript -->
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
