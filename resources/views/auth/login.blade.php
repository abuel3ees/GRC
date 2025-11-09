{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    {{-- We remove the extra min-h-screen/flex wrapper since guest-layout already handles centering --}}
    <div class="w-full max-w-md bg-card text-card-foreground p-8 rounded-xl shadow-lg border border-border/60">

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 text-3xl font-bold font-sans tracking-tighter hover:opacity-80 transition">
                <span class="text-foreground">GRC</span>
                <span class="text-muted-foreground font-light">Platform</span>
            </a>
        </div>

        {{-- Header --}}
        <div class="text-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight mb-1">Welcome Back</h1>
            <p class="text-sm text-muted-foreground">Sign in to continue to your dashboard</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-foreground font-medium" />
                <x-text-input id="email"
                    class="block mt-1 w-full bg-input border border-border text-foreground rounded-md px-3 py-2 focus:ring-2 focus:ring-ring/60 focus:border-ring/60 transition"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-destructive text-sm" />
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-foreground font-medium" />
                <x-text-input id="password"
                    class="block mt-1 w-full bg-input border border-border text-foreground rounded-md px-3 py-2 focus:ring-2 focus:ring-ring/60 focus:border-ring/60 transition"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-destructive text-sm" />
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center space-x-2 cursor-pointer select-none">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-input border border-border text-accent focus:ring-ring/50"
                        name="remember">
                    <span class="text-sm text-muted-foreground">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-accent hover:underline focus:outline-none focus:ring-2 focus:ring-ring/50 rounded transition">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            {{-- Login Button --}}
            <div class="text-center">
                <x-primary-button
                    class="w-full py-2.5 bg-foreground text-background font-semibold rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/60 transition">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        {{-- Divider --}}
        <div class="mt-6 border-t border-border/50"></div>

        {{-- Create Account --}}
        <p class="text-sm text-muted-foreground mt-6 text-center">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-accent hover:underline font-medium">
                Create one
            </a>
        </p>
    </div>
</x-guest-layout>
