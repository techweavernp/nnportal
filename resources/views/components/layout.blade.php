<!DOCTYPE html>
<html lang="ne">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>नेपाल न्युज पोर्टल</title>
    <meta name="description" content="Nepal News Portal, Nepal's fastest-growing news platform. Real stories, real impact.">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />

    <link rel="canonical" href="https://nepalnewsportal.com/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="नेपाल न्युज पोर्टल" />
    <meta property="og:description" content="Nepal&#039;s fastest-growing news platform. Real stories, real impact." />
    <meta property="og:url" content="https://nepalnewsportal.com/" />
    <meta property="og:site_name" content="नेपाल न्युज पोर्टल" />
    <meta property="og:image" content="https://nepalnewsportal.com/wp-content/uploads/2026/02/Newsportal-Banner-500x265.png" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="265" />
    <meta property="og:image:type" content="image/png" />
    <meta name="twitter:card" content="summary_large_image" />

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
