<header 
    x-data="{ isOpen: false }"
    class="sticky top-0 z-50 w-full border-b border-border bg-background/95 backdrop-blur"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== Top Bar ===== --}}
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold font-sans tracking-tighter">
                    GRC
                </a>
            </div>

            {{-- ===== Navigation (Desktop) ===== --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('solutions') }}" class="text-sm font-medium hover:opacity-70 transition">Solutions</a>
                <a href="{{ route('platform') }}" class="text-sm font-medium hover:opacity-70 transition">Platform</a>
                <a href="{{ route('resources') }}" class="text-sm font-medium hover:opacity-70 transition">Resources</a>
                <a href="{{ route('company') }}" class="text-sm font-medium hover:opacity-70 transition">Company</a>
            </nav>

            {{-- ===== Auth Buttons (Desktop) ===== --}}
            <div class="hidden md:flex items-center gap-4">
                @guest
                    {{-- When user is NOT logged in --}}
                    <a href="{{ route('login') }}" 
                       class="px-6 py-2 text-sm font-medium border border-foreground hover:bg-foreground hover:text-background transition">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-6 py-2 text-sm font-medium bg-foreground text-background hover:opacity-90 transition">
                        Get Started
                    </a>
                @endguest

                @auth
                    {{-- ✅ Spatie role check --}}
                    @if(auth()->user()->hasRole('Admin'))
                        <a href="{{ route('admin.dashboard') }}" 
                           class="px-6 py-2 text-sm font-medium bg-foreground text-background hover:opacity-90 transition">
                            Admin Dashboard
                        </a>
                    @else
                        {{-- Regular user: show logout only --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="px-6 py-2 text-sm font-medium border border-foreground text-foreground hover:bg-foreground hover:text-background transition">
                                Logout
                            </button>
                        </form>
                    @endif
                @endauth
            </div>

            {{-- ===== Mobile Menu Button ===== --}}
            <button 
                class="md:hidden text-foreground focus:outline-none" 
                @click="isOpen = !isOpen"
                aria-label="Toggle Menu"
            >
                <template x-if="!isOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="6" x2="20" y2="6" />
                        <line x1="4" y1="12" x2="20" y2="12" />
                        <line x1="4" y1="18" x2="20" y2="18" />
                    </svg>
                </template>
                <template x-if="isOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </template>
            </button>
        </div>

        {{-- ===== Mobile Navigation ===== --}}
        <nav 
            x-show="isOpen" 
            x-transition 
            class="md:hidden pb-4 space-y-3"
        >
            <a href="{{ route('solutions') }}" class="block text-sm font-medium hover:opacity-70 py-2">Solutions</a>
            <a href="{{ route('platform') }}" class="block text-sm font-medium hover:opacity-70 py-2">Platform</a>
            <a href="{{ route('resources') }}" class="block text-sm font-medium hover:opacity-70 py-2">Resources</a>
            <a href="{{ route('company') }}" class="block text-sm font-medium hover:opacity-70 py-2">Company</a>

            {{-- ===== Auth Buttons (Mobile) ===== --}}
            <div class="pt-4 flex flex-col gap-3">
                @guest
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 text-sm font-medium border border-foreground hover:bg-foreground hover:text-background transition text-center">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 text-sm font-medium bg-foreground text-background hover:opacity-90 transition text-center">
                        Get Started
                    </a>
                @endguest

                @auth
                    @if(auth()->user()->hasRole('Admin'))
                        <a href="{{ route('admin.dashboard') }}" 
                           class="px-4 py-2 text-sm font-medium bg-foreground text-background hover:opacity-90 transition text-center">
                            Admin Dashboard
                        </a>
                    @else
                        <form method="POST" action="{{ route('logout') }}" class="text-center">
                            @csrf
                            <button type="submit"
                                    class="w-full px-4 py-2 text-sm font-medium border border-foreground text-foreground hover:bg-foreground hover:text-background transition">
                                Logout
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </nav>
    </div>
</header>
