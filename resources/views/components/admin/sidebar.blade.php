<aside x-data="{ isOpen: true }" class="relative">

    {{-- ===== Mobile Toggle Button ===== --}}
    <button 
        @click="isOpen = !isOpen" 
        class="fixed left-4 top-4 z-50 md:hidden text-foreground hover:opacity-80 transition"
    >
        <template x-if="isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </template>
        <template x-if="!isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="18" x2="20" y2="18" />
            </svg>
        </template>
    </button>

    {{-- ===== Sidebar Panel ===== --}}
    <div 
        class="fixed inset-y-0 left-0 z-40 w-64 border-r border-border bg-background transition-transform duration-300 md:relative md:translate-x-0"
        :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="flex h-full flex-col">

            {{-- ===== Logo ===== --}}
            <div class="border-b border-border px-6 py-8">
                <h1 class="text-2xl font-bold tracking-tight">GRC</h1>
                <p class="text-xs text-muted-foreground mt-1">Admin Panel</p>
            </div>

            {{-- ===== Navigation ===== --}}
            <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-6">

                @php
                    $links = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],

                        // === Core GRC Entities ===
                        ['route' => 'admin.assessments.index', 'label' => 'Assessments', 'icon' => 'clipboard-check'],
                        ['route' => 'admin.assessment-results.index', 'label' => 'Assessment Results', 'icon' => 'list-check'],
                        ['route' => 'admin.risks.index', 'label' => 'Risks', 'icon' => 'alert-triangle'],
                        ['route' => 'admin.controls.index', 'label' => 'Controls', 'icon' => 'shield'],
                        ['route' => 'admin.policies.index', 'label' => 'Policies', 'icon' => 'file-text'],

                        // === Relation Tables ===
                        ['route' => 'admin.risk-controls.index', 'label' => 'Risk–Control Mapping', 'icon' => 'link'],
                        ['route' => 'admin.requirements.index', 'label' => 'Compliance Requirements', 'icon' => 'check-circle-2'],

                        // === Governance & Users ===
                        ['route' => 'admin.users.index', 'label' => 'Users', 'icon' => 'users'],
                        ['route' => 'admin.roles.index', 'label' => 'Roles & Permissions', 'icon' => 'key-round'],

                        // === Analytics / Settings ===
                        ['route' => 'admin.analytics.index', 'label' => 'Analytics', 'icon' => 'bar-chart-3'],
                        ['route' => 'admin.settings.index', 'label' => 'Settings', 'icon' => 'settings'],
                    ];
                @endphp

                @foreach ($links as $link)
                    @php
                        $active = request()->routeIs($link['route'].'*');
                    @endphp
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-3 rounded px-4 py-3 text-sm font-medium transition-colors
                              {{ $active ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-secondary hover:text-secondary-foreground' }}">
                        <x-dynamic-component :component="'lucide-'.$link['icon']" class="w-5 h-5" />
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- ===== Footer ===== --}}
            <div class="border-t border-border px-6 py-4">
                <p class="text-xs text-muted-foreground">
                    © {{ now()->year }} GRC Platform<br>
                    <span class="text-[11px]">Governance · Risk · Compliance</span>
                </p>
            </div>
        </div>
    </div>

    {{-- ===== Mobile Overlay ===== --}}
    <div 
        x-show="isOpen"
        x-transition.opacity
        class="fixed inset-0 z-30 bg-black/20 md:hidden"
        @click="isOpen = false"
    ></div>
</aside>
