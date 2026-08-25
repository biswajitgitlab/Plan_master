<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Event Management</title>
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
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "tertiary": "#9e4300"
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                    spacing: { "stack-md": "16px", "stack-lg": "32px", "container-padding": "24px", "stack-sm": "8px" },
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
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex flex-col">
                    <span class="font-label-md text-on-surface">{{ auth()->user()->name ?? 'Admin User' }}</span>
                    <span class="text-xs text-on-surface-variant">{{ auth()->user()->getRoleNames()->first() ?? 'Admin' }}</span>
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
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label-md">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="{{ route('admin.events.index') }}">
                <span class="material-symbols-outlined" data-weight="fill">calendar_month</span>
                <span>Events</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('approvals.index') }}">
                <span class="material-symbols-outlined">fact_check</span>
                <span class="font-label-md">Approvals</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg pt-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Event Management</h1>
                <p class="font-body-md text-on-surface-variant">Create and monitor corporate events, participant quotas, and approval rules.</p>
            </div>
            <div>
                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-full font-label-md hover:bg-primary/90 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Create New Event
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($events as $event)
                @php
                    $totalCapacity = $event->quotas->sum('quota_limit');
                    $activeRegsCount = $event->registrations->where('status', '!=', 'rejected')->count();
                    $waitlistCount = $event->registrations->where('status', 'waitlisted')->count();
                    $percent = $totalCapacity > 0 ? min(100, round(($activeRegsCount / $totalCapacity) * 100)) : 0;
                @endphp
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col relative group">
                    <div class="absolute top-0 left-0 w-full h-1 {{ $percent >= 90 ? 'bg-error' : ($percent >= 70 ? 'bg-tertiary' : 'bg-primary') }} z-10"></div>
                    @if($event->image_path)
                        <div class="h-36 w-full relative bg-surface-variant overflow-hidden">
                            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        </div>
                    @endif
                    <div class="p-6 flex flex-col gap-4 flex-grow">
                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <h2 class="font-headline-md text-lg font-bold text-on-surface mb-1">{{ $event->name }}</h2>
                                <p class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    {{ $event->start_date->format('M d, Y') }}
                                </p>
                            </div>
                            <span class="px-2.5 py-1 text-xs rounded-full font-semibold {{ $percent >= 90 ? 'bg-error-container text-on-error-container' : 'bg-primary-fixed text-on-primary-fixed-variant' }}">
                                {{ $percent >= 90 ? 'High Demand' : 'Active' }}
                            </span>
                        </div>

                        <p class="text-xs text-on-surface-variant line-clamp-2">{{ $event->description ?? 'No description provided.' }}</p>

                        <div>
                            <div class="flex justify-between font-label-md text-xs mb-1.5">
                                <span class="text-on-surface">Overall Quota Usage</span>
                                <span class="font-bold text-primary">{{ $activeRegsCount }} / {{ $totalCapacity > 0 ? $totalCapacity : 'Unlimited' }} ({{ $percent }}%)</span>
                            </div>
                            <div class="w-full bg-surface-container-highest rounded-full h-2 overflow-hidden">
                                <div class="h-2 rounded-full {{ $percent >= 90 ? 'bg-error' : 'bg-primary' }}" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>

                        <!-- Role Quotas breakdown -->
                        @if($event->quotas->count() > 0)
                            <div class="grid grid-cols-3 gap-2 py-2 border-y border-outline-variant/40">
                                @foreach($event->quotas as $quota)
                                    @php
                                        $roleRegs = $event->registrations->where('status', '!=', 'rejected')->filter(fn($r) => $r->user && $r->user->hasRole($quota->role_name))->count();
                                    @endphp
                                    <div class="flex flex-col gap-0.5 text-center">
                                        <span class="text-[11px] text-on-surface-variant font-medium truncate">{{ $quota->role_name }}</span>
                                        <span class="text-xs font-bold text-on-surface">{{ $roleRegs }}/{{ $quota->quota_limit }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex items-center gap-2 mt-auto text-on-surface-variant text-xs font-medium">
                            <span class="material-symbols-outlined text-[16px]">group</span>
                            <span>{{ $waitlistCount }} registrant(s) on waitlist</span>
                        </div>
                    </div>

                    <div class="bg-surface-container-low px-6 py-3 border-t border-outline-variant flex justify-end gap-3">
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-label-md text-xs text-error hover:bg-error-container px-3 py-1.5 rounded transition-colors">Delete</button>
                        </form>
                        <a href="{{ route('admin.events.edit', $event) }}" class="font-label-md text-xs bg-white border border-outline-variant text-on-surface hover:bg-surface-container px-4 py-1.5 rounded-full transition-colors font-semibold">
                            Edit & Manage
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">event_busy</span>
                    <p class="font-medium">No events found in system.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>