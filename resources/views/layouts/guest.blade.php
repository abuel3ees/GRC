<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GRC Platform') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-foreground transition-colors duration-300">

    <div class="min-h-screen flex flex-col justify-center items-center p-6 bg-background text-foreground">

        {{-- ===== Logo / Branding ===== --}}
        <div class="mb-8 text-center">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 group">
                <div class="text-4xl font-extrabold tracking-tighter group-hover:opacity-90 transition">
                    GRC
                </div>
                <p class="text-sm text-muted-foreground">
                    Governance, Risk & Compliance
                </p>
            </a>
        </div>

        {{-- ===== Auth Card ===== --}}
        <div class="w-full sm:max-w-md bg-card text-card-foreground rounded-xl border border-border/60 shadow-lg overflow-hidden">
            <div class="px-8 py-6 sm:px-10">
                {{ $slot }}
            </div>
        </div>

        {{-- ===== Footer (optional for guest layout) ===== --}}
        <p class="mt-8 text-xs text-muted-foreground text-center">
            © {{ now()->year }} GRC Platform — All rights reserved.
        </p>
    </div>

</body>
</html>
