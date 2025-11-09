@extends('layouts.app')

@section('title', 'Home – GRC Platform')

@section('content')
<main class="min-h-screen bg-background text-foreground">
    {{-- ===== Header Section ===== --}}
    @include('components.header')

    {{-- ===== Hero Section ===== --}}
    @include('components.hero')

    {{-- ===== Features Section ===== --}}
    @include('components.features')

    {{-- ===== Solutions Section ===== --}}
    @include('components.solutions')

    {{-- ===== Call To Action (CTA) Section ===== --}}
    @include('components.cta')

    {{-- ===== Footer Section ===== --}}
    @include('components.footer')
</main>
@endsection
