<!DOCTYPE html>
<html lang="ne">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>४०४ - पृष्ठ भेटिएन | Nepal News Portal</title>
    <meta name="description" content="माफ गर्नुहोस्, तपाईंले खोज्नुभएको पृष्ठ फेला परेन।">

    <!-- Google Fonts - Anek Devanagari -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --primary-red: #CC0000;
            --dark-red: #b91c1c;
            --white: #ffffff;
            --black: #080808;
            --dark-gray: #1f1f1f;
            --medium-gray: #4a4a4a;
            --light-gray: #6b6b6b;
            --bg-gray: #f8fafc;
            --glass: rgba(255, 255, 255, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Anek Devanagari', sans-serif;
            background-color: var(--bg-gray);
            color: var(--dark-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;
            overflow-x: hidden;
            text-align: center;
        }

        /* Animated Background Elements */
        .background-blob {
            position: absolute;
            width: min(80vw, 600px);
            height: min(80vw, 600px);
            background: linear-gradient(135deg, rgba(204, 0, 0, 0.08) 0%, rgba(204, 0, 0, 0.03) 100%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 20s infinite alternate linear;
        }

        .blob-1 {
            top: -200px;
            right: -100px;
        }

        .blob-2 {
            bottom: -200px;
            left: -100px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(40px, 60px) scale(1.1);
            }

            66% {
                transform: translate(-30px, 30px) scale(0.9);
            }

            100% {
                transform: translate(0, 0) scale(1);
            }
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: var(--glass);
            backdrop-filter: blur(15px);
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.08);
            animation: scaleIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .logo {
            margin-bottom: 2.5rem;
            animation: fadeInDown 1s ease-out;
        }

        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 20px;
            padding: 10px;
            background: var(--white);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .text-animation-wrapper {
            margin-bottom: 2rem;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .not-found-text {
            font-size: clamp(2.5rem, 10vw, 4.5rem);
            font-weight: 800;
            color: var(--primary-red);
            line-height: 2  ;
            letter-spacing: -1px;
            position: relative;
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulseText 3s infinite ease-in-out;
            display: inline-block;
        }

        .not-found-text::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 4px;
            background: var(--primary-red);
            border-radius: 2px;
            transform: scaleX(0);
            animation: underlineGrow 1s ease-out 0.5s forwards;
        }

        @keyframes pulseText {

            0%,
            100% {
                transform: scale(1);
                filter: drop-shadow(0 0 0 rgba(204, 0, 0, 0));
            }

            50% {
                transform: scale(1.05);
                filter: drop-shadow(0 5px 15px rgba(204, 0, 0, 0.2));
            }
        }

        @keyframes underlineGrow {
            to {
                transform: scaleX(1);
            }
        }

        h1 {
            font-size: clamp(1.5rem, 6vw, 2.2rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--black);
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        p {
            font-size: clamp(1rem, 4vw, 1.2rem);
            color: var(--medium-gray);
            margin-bottom: 3rem;
            line-height: 1.7;
            animation: fadeInUp 1s ease-out 0.5s both;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        .actions {
            display: flex;
            gap: 1.25rem;
            justify-content: center;
            animation: fadeInUp 1s ease-out 0.7s both;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background-color: var(--primary-red);
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 25px rgba(204, 0, 0, 0.2);
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-5px) scale(1.03);
            background-color: var(--dark-red);
            box-shadow: 0 15px 35px rgba(204, 0, 0, 0.3);
        }

        .btn svg {
            transition: transform 0.3s ease;
        }

        .btn:hover svg {
            transform: translateX(-5px);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--dark-gray);
            border: 2px solid #e2e8f0;
            box-shadow: none;
        }

        .btn-outline:hover {
            background-color: var(--white);
            border-color: var(--primary-red);
            color: var(--primary-red);
            transform: translateY(-5px);
        }

        /* Status 404 badge */
        .status-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            background: rgba(204, 0, 0, 0.1);
            color: var(--primary-red);
            padding: 5px 15px;
            border-radius: 100px;
            font-weight: 800;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        /* Animations */
        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Optimization */
        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 2.5rem 1.25rem;
                border-radius: 30px;
            }

            .actions {
                flex-direction: column;
                width: 100%;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
                padding: 1.1rem;
            }

            .status-badge {
                top: 15px;
                right: 15px;
                font-size: 0.8rem;
            }

            .logo {
                margin-bottom: 1.5rem;
            }

            .logo img {
                width: 70px;
                height: 70px;
            }

            .text-animation-wrapper {
                min-height: 80px;
            }
        }
    </style>
</head>

<body>
<!-- Decorative background -->
<div class="background-blob blob-1"></div>
<div class="background-blob blob-2"></div>

<div class="container">
    <div class="status-badge">ERR: 404</div>

    <!-- Brand Icon -->
    <div class="logo">
        <a href="/">
            <img src="{{asset('assets/images/icon.png')}}" alt="Portal Icon">
        </a>
    </div>

    <!-- Animated Text -->
    <div class="text-animation-wrapper">
        <div class="not-found-text">पृष्ठ भेटिएन !</div>
    </div>

    <!-- Message -->
    <h1>माफ गर्नुहोस्, केही गलत भयो</h1>
    <p>तपाईंले खोज्नुभएको सामग्री फेला परेन। कृपया गृहपृष्ठमा जानुहोस् वा अन्य समाचारहरू हेर्नुहोस्।</p>

    <!-- CTA Actions -->
    <div class="actions">
        <a href="/" class="btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            गृहपृष्ठमा फर्कनुहोस्
        </a>
        <a href="/category/main-news" class="btn btn-outline">
            मुख्य समाचार
        </a>
    </div>
</div>
</body>

</html>
