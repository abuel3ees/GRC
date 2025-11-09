<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — GRC Platform</title>

    <!-- ===== Fonts ===== -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ===== AOS (Animate On Scroll) CSS ===== -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <!-- ===== Vite Assets ===== -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-foreground">

    <div class="flex h-screen overflow-hidden">

        {{-- ===== Sidebar ===== --}}
        @include('components.admin.sidebar')

        {{-- ===== Main Content ===== --}}
        <div class="flex flex-1 flex-col overflow-hidden">

            {{-- ===== Header ===== --}}
            @include('components.admin.header')

            {{-- ===== Page Content ===== --}}
            <main class="flex-1 overflow-y-auto p-8 space-y-10">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- ===== AOS JS ===== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    {{-- ===== Initialize AOS ===== --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.AOS) {
                AOS.init({
                    duration: 800,
                    offset: 80,
                    easing: 'ease-in-out',
                    once: true
                });
                console.log('✅ AOS initialized successfully');
            } else {
                console.error('❌ AOS not found — check script include');
            }
        });
    </script>

    {{-- ===== Stack for page-specific scripts ===== --}}
    @stack('scripts')
</body>
</html>
