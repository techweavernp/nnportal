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
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="नेपाल न्युज पोर्टल" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
    <!-- Facebook OG Tags -->
    @endif

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

{{$slot}}

<x-footer/>

<!-- JavaScript -->
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
