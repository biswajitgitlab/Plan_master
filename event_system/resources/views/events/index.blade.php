<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>EventCentral - Browse Events</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-fixed": "#d8e2ff",
                        "primary-container": "#1a73e8",
                        "on-primary-container": "#ffffff",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#414754",
                        "surface-container": "#eceef0",
                        "surface-container-high": "#e6e8ea",
                        "surface-container-low": "#f2f4f6",
                        "surface-container-lowest": "#ffffff",
                        "surface-bright": "#f7f9fb",
                        "background": "#f7f9fb",
                        "outline-variant": "#c1c6d6",
                        "primary": "#005bbf",
                        "error": "#ba1a1a"
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                    spacing: { "stack-md": "16px", "stack-lg": "32px", "container-padding": "24px", "stack-sm": "8px", "gutter": "16px" },
                    fontFamily: { "headline-lg": ["Inter"], "headline-md": ["Inter"], "body-md": ["Inter"], "label-md": ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined[data-weight="fill"] { font-variation-settings: 'FILL' 1; }
    </style>
</head>
<body class="bg-[#f8fafc] text-on-surface font-body-md antialiased flex flex-col md:flex-row min-h-screen bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] relative overflow-x-hidden">
    <!-- Ambient Glow Orbs -->
    <div class="fixed top-0 right-0 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed bottom-0 left-72 w-[500px] h-[500px] bg-primary-container/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- Desktop SideNav -->
    <nav class="hidden md:flex h-full w-72 fixed left-0 top-0 bg-surface-container/90 backdrop-blur-xl flex-col p-4 gap-stack-sm z-40 border-r border-outline-variant/60 shadow-sm">
        <div class="flex items-center gap-2 mb-stack-lg px-2 pt-2">
            <span class="material-symbols-outlined text-primary text-[32px]" data-weight="fill">event_available</span>
            <span class="font-headline-md font-bold text-primary">EventCentral</span>
        </div>
        <div class="flex items-center justify-between px-4 py-3 mb-stack-md bg-surface-container-high rounded-lg">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="flex flex-col">
                    <span class="font-label-md text-on-surface">{{ auth()->user()->name ?? 'Participant' }}</span>
                    <span class="text-xs text-on-surface-variant">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="Logout" class="text-on-surface-variant hover:text-error transition-colors">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                </button>
            </form>
        </div>
        <div class="flex flex-col gap-1">
            @if(auth()->user()->hasRole('Admin'))
                <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md">Dashboard</span>
                </a>
            @endif
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="{{ route('events.index') }}">
                <span class="material-symbols-outlined" data-weight="fill">calendar_month</span>
                <span>Events</span>
            </a>
            @if(auth()->user()->hasAnyRole(['Admin', 'Sub-Admin', 'Manager']))
                <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('approvals.index') }}">
                    <span class="material-symbols-outlined">fact_check</span>
                    <span class="font-label-md">Approvals</span>
                </a>
            @endif
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] mx-auto w-full pb-24 md:pb-container-padding">
        <header class="mb-stack-lg pt-4">
            <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Upcoming Corporate Events</h1>
            <p class="font-body-md text-on-surface-variant max-w-2xl">Browse available workshops, summits, and executive sessions to register or request attendance approval.</p>
        </header>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-amber-50 text-amber-800 border border-amber-200 rounded-xl flex items-center gap-2 font-medium">
                <span class="material-symbols-outlined text-amber-600">info</span>
                {{ session('error') }}
            </div>
        @endif

        <!-- Event Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            @forelse($events as $event)
                @php
                    $userRoleName = auth()->user()->getRoleNames()->first() ?? 'Employee';
                    $roleQuota = $event->quotas->where('role_name', $userRoleName)->first();
                    $registeredRoleCount = $event->registrations->where('status', '!=', 'rejected')->filter(fn($r) => $r->user && $r->user->hasRole($userRoleName))->count();
                    $isFull = $roleQuota && $registeredRoleCount >= $roleQuota->quota_limit;
                    $userReg = $event->registrations->where('user_id', auth()->id())->first();
                @endphp
                <article class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm flex flex-col group hover:shadow-md transition-all">
                    <div class="h-40 w-full relative bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-[48px] text-outline opacity-40">event</span>
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur px-2.5 py-1 rounded-md border border-outline-variant/50">
                            <span class="font-label-md text-xs text-primary flex items-center gap-1 font-semibold">
                                <span class="material-symbols-outlined text-[14px]">event</span>
                                {{ $event->start_date->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2 gap-2">
                            <h3 class="font-bold text-base text-on-surface group-hover:text-primary transition-colors line-clamp-1">{{ $event->name }}</h3>
                            @if($userReg)
                                <span class="px-2 py-0.5 text-[10px] uppercase font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    {{ ucfirst($userReg->status) }}
                                </span>
                            @elseif($isFull)
                                <span class="px-2 py-0.5 text-[10px] uppercase font-bold rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                                    Waitlist Only
                                </span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] uppercase font-bold rounded-full bg-primary-fixed text-on-primary-fixed-variant">
                                    Available
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-on-surface-variant mb-4 flex-1 line-clamp-2">{{ $event->description ?? 'No detailed description available.' }}</p>
                        <div class="flex items-center gap-2 mb-4 text-xs text-on-surface-variant font-medium">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            <span>{{ $event->location ?? 'Virtual Platform' }}</span>
                        </div>
                        <div class="pt-4 border-t border-outline-variant/50 mt-auto">
                            <a href="{{ route('events.show', $event) }}" class="block w-full py-2.5 bg-primary text-white text-center rounded-lg font-label-md hover:bg-primary/90 transition-colors shadow-sm font-semibold">
                                {{ $userReg ? 'View Registration Status' : ($isFull ? 'Join Waitlist' : 'Register Now') }}
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-12 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">event_busy</span>
                    <p class="font-medium">No upcoming events scheduled right now.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>