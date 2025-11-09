<header class="border-b border-border bg-background px-8 py-4">
    <div class="flex items-center justify-between">

        {{-- ===== Search Bar ===== --}}
        <div class="flex flex-1 items-center gap-2">
            <x-lucide-search class="w-5 h-5 text-muted-foreground" />
            <input
                type="text"
                placeholder="Search..."
                class="flex-1 bg-transparent text-sm placeholder-muted-foreground outline-none focus:ring-0"
            />
        </div>

        {{-- ===== Actions ===== --}}
        <div class="flex items-center gap-4">

            {{-- Notifications Button --}}
            <button class="relative p-2 rounded-md hover:bg-secondary transition">
                <x-lucide-bell class="w-5 h-5 text-foreground" />
                <span class="absolute right-1 top-1 h-2 w-2 rounded-full bg-destructive"></span>
            </button>

            {{-- User Button --}}
            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open" 
                    class="flex items-center gap-2 rounded-md px-3 py-2 hover:bg-secondary transition"
                >
                    <x-lucide-user class="w-5 h-5 text-foreground" />
                    <span class="text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
                </button>

                {{-- Dropdown --}}
                <div 
                    x-show="open" 
                    @click.away="open = false" 
                    x-transition
                    class="absolute right-0 mt-2 w-40 bg-card border border-border rounded-md shadow-lg z-50"
                >
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-2 text-sm text-foreground hover:bg-muted transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full text-left px-4 py-2 text-sm text-destructive hover:bg-muted transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
