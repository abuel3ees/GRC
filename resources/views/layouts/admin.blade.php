<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — GRC Platform</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" 
          integrity="sha512-p2Fx3R0S2aAbD2LrVJRektpVGSCvG1e6ZrhbvMOB6JHckW2QrRFe8y4QUuGbbXYmXyBoFxXncD6wGfHo9dKTAA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-foreground">
    <div class="flex h-screen overflow-hidden">

        {{-- ===== Sidebar ===== --}}
        @include('components.admin.sidebar')

        {{-- ===== Main Content ===== --}}
        <div class="flex flex-1 flex-col overflow-hidden">

            {{-- Header --}}
            @include('components.admin.header')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" 
            integrity="sha512-0jXkNvZK8bqG8xZoC8wL5m2jAtq9oO0w6R3NPHK0KoXxk0M70vTPEF4KnH+bMcyWOKY2NnR4iI1xQy6HWZ8OZA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 700,   // smooth and subtle
                offset: 50,      // trigger slightly before visible
                easing: 'ease-in-out',
                once: true       // animate only once per element
            });
        });
    </script>

    {{-- Stack for extra per-page scripts --}}
    @stack('scripts')
</body>
</html>
