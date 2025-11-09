<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Enterprise-grade governance, risk, and compliance platform">
    <meta name="generator" content="v0.app">

    <title>@yield('title', 'GRC - Governance, Risk & Compliance Platform')</title>

    {{-- ===== Favicon & Icons ===== --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon-light-32x32.png') }}" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon-dark-32x32.png') }}" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/svg+xml" href="{{ asset('icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-icon.png') }}">

    {{-- ===== Fonts (Roboto Flex) ===== --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- ===== Vite CSS ===== --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background text-foreground min-h-screen flex flex-col">

    {{-- ===== Page Content ===== --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ===== Analytics Placeholder ===== --}}
    {{-- If you want to integrate analytics (like Vercel or GA4), put their scripts here --}}
    {{-- Example:
    <script src="https://www.googletagmanager.com/gtag/js?id=G-XXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXX');
    </script>
    --}}

</body>
</html>
