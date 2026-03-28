<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'MICRO MLM'))</title>

    <meta name="description" content="@yield('description', 'Best MLM Software Development Company in India')">
    <meta name="keywords" content="@yield('keywords', 'MLM software, Binary MLM, Matrix MLM')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ config('app.name', 'MICRO MLM') }}">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="@yield('og_title', 'Best MLM Software Development Company in India')">
    <meta property="og:description" content="@yield('og_description', 'Professional MLM software solutions')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Best MLM Software')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Professional MLM software company')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #0A0A0F;
            --bg2: #111118;
            --accent: #8b5cf6;
            --text: #F0EDE6;
            --textMuted: rgba(240,237,230,0.6);
            --border: rgba(139,92,246,0.18);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 3rem;
            background: rgba(10,10,15,0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            color: var(--accent);
            font-size: 1.3rem;
            text-decoration: none;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            margin-left: 3rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--textMuted);
            text-decoration: none;
        }

        .nav-links a:hover {
            color: var(--text);
        }

        .page-content {
            min-height: 100vh;
            padding-top: 64px;
        }

        .footer {
            padding: 4rem 1.5rem;
            text-align: center;
            background: var(--bg2);
            border-top: 1px solid var(--border);
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .footer-links a {
            color: var(--textMuted);
            text-decoration: none;
            font-size: 0.85rem;
        }

        .footer-links a:hover {
            color: var(--accent);
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    <nav class="nav">
        <a href="{{ url('/') }}" class="nav-logo">MICRO MLM</a>

        <ul class="nav-links">
            <li><a href="{{ route('website.features') }}">Features</a></li>
            <li><a href="{{ route('website.pricing') }}">Pricing</a></li>
            <li><a href="{{ route('website.contact') }}">Contact</a></li>
        </ul>
    </nav>

    {{-- Page Content --}}
    <main class="page-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div style="font-size:1.5rem; color:var(--accent); margin-bottom:1rem;">
            MICRO MLM
        </div>

        <div class="footer-links">
            <a href="{{ route('website.pricing') }}">Pricing</a>
            <a href="{{ route('website.features') }}">Features</a>
            <a href="{{ route('website.contact') }}">Contact</a>
            <a href="{{ route('website.binary-plan') }}">Binary Plan</a>
            <a href="{{ route('website.unilevel-plan') }}">Unilevel Plan</a>
        </div>

        <div style="font-size:0.75rem; color:var(--textMuted);">
            © {{ date('Y') }} {{ config('app.name', 'MICRO MLM') }}
        </div>
    </footer>

    @stack('scripts')
</body>
</html>