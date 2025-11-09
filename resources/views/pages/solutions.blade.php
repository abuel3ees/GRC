@extends('layouts.app')

@section('title', 'Solutions | GRC Platform')

@section('content')
@include('components.header')

<section class="min-h-screen flex flex-col items-center justify-center text-center bg-background text-foreground px-6 py-20">
    <h1 class="text-5xl md:text-6xl font-bold font-sans tracking-tighter mb-6">Industry Solutions</h1>
    <p class="text-lg text-muted-foreground max-w-2xl">
        Discover how our GRC platform empowers Financial, Healthcare, and Technology organizations to simplify compliance and risk management.
    </p>

    <div class="mt-16 w-full max-w-6xl">
        @include('components.solutions')
    </div>
</section>

@include('components.footer')
@endsection
