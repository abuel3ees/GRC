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

            {{-- Navigation - Desktop --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="#" class="text-sm font-medium hover:opacity-70 transition">Solutions</a>
                <a href="#" class="text-sm font-medium hover:opacity-70 transition">Platform</a>
                <a href="#" class="text-sm font-medium hover:opacity-70 transition">Resources</a>
                <a href="#" class="text-sm font-medium hover:opacity-70 transition">Company</a>
            </nav>

            {{-- CTA Buttons - Desktop --}}
            <div class="hidden md:flex items-center gap-4">
                <a href="#" 
                   class="px-6 py-2 text-sm font-medium border border-foreground hover:bg-foreground hover:text-background transition">
                    Sign In
                </a>
                <a href="#" 
                   class="px-6 py-2 text-sm font-medium bg-foreground text-background hover:opacity-90 transition">
                    Get Started
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button 
                class="md:hidden text-foreground focus:outline-none" 
                @click="isOpen = !isOpen"
                aria-label="Toggle Menu"
            >
                <template x-if="!isOpen">
                    {{-- Menu Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="6" x2="20" y2="6" />
                        <line x1="4" y1="12" x2="20" y2="12" />
                        <line x1="4" y1="18" x2="20" y2="18" />
                    </svg>
                </template>
                <template x-if="isOpen">
                    {{-- Close Icon --}}
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
            <a href="#" class="block text-sm font-medium hover:opacity-70 py-2">Solutions</a>
            <a href="#" class="block text-sm font-medium hover:opacity-70 py-2">Platform</a>
            <a href="#" class="block text-sm font-medium hover:opacity-70 py-2">Resources</a>
            <a href="#" class="block text-sm font-medium hover:opacity-70 py-2">Company</a>

            <div class="pt-4 flex gap-3">
                <a href="#" 
                   class="flex-1 px-4 py-2 text-sm font-medium border border-foreground hover:bg-foreground hover:text-background transition text-center">
                    Sign In
                </a>
                <a href="#" 
                   class="flex-1 px-4 py-2 text-sm font-medium bg-foreground text-background hover:opacity-90 transition text-center">
                    Get Started
                </a>
            </div>
        </nav>
    </div>
</header>
