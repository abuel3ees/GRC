@extends('layouts.app')

@section('title', 'Resources | GRC Platform')

@section('content')
@include('components.header')

<section class="min-h-screen flex flex-col items-center justify-center text-center bg-background text-foreground px-6 py-20">
    <h1 class="text-5xl md:text-6xl font-bold font-sans tracking-tighter mb-6">Resources</h1>
    <p class="text-lg text-muted-foreground max-w-2xl">
        Access articles, whitepapers, and documentation to strengthen your compliance strategy.
    </p>

    <div class="mt-16 text-sm text-muted-foreground">
        <p>Coming soon: Documentation, Blog, and Knowledge Base.</p>
    </div>
</section>

@include('components.footer')
@endsection
