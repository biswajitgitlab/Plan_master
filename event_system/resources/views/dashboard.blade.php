<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard - EventCentral</title>
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
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined" data-weight="fill">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('events.index') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="font-label-md">Events</span>
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
        <header class="mb-stack-lg pt-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Welcome, {{ auth()->user()->name }}</h1>
                <p class="font-body-md text-on-surface-variant">Here is an overview of your registrations and upcoming corporate events.</p>
            </div>
            @if(auth()->user()->hasRole('Admin'))
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-primary text-white rounded-full font-label-md hover:bg-primary/90 transition-colors shadow-sm inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                    Switch to Admin Panel
                </a>
            @endif
        </header>

        <!-- User Registrations Summary -->
        @php
            $myRegistrations = \App\Models\Registration::with('event')->where('user_id', auth()->id())->latest()->get();
        @endphp

        <div class="mb-8">
            <h2 class="text-lg font-bold text-on-surface mb-4">My Event Registrations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($myRegistrations as $reg)
                    <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-xl shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-on-surface text-base">{{ $reg->event->name }}</h3>
                                <span class="px-2.5 py-0.5 text-[10px] uppercase font-bold rounded-full {{ $reg->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : ($reg->status === 'waitlisted' ? 'bg-amber-100 text-amber-800' : ($reg->status === 'rejected' ? 'bg-error-container text-on-error-container' : 'bg-primary-fixed text-on-primary-fixed-variant')) }}">
                                    {{ $reg->status }}
                                </span>
                            </div>
                            <p class="text-xs text-on-surface-variant flex items-center gap-1 mb-3">
                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                {{ $reg->event->start_date->format('M d, Y') }}
                            </p>
                        </div>
                        <a href="{{ route('events.show', $reg->event) }}" class="text-xs text-primary font-semibold hover:underline flex items-center gap-1 mt-2">
                            View Details & Status →
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                        You have not registered for any events yet. <a href="{{ route('events.index') }}" class="text-primary font-semibold hover:underline">Browse events</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- All Upcoming Events -->
        <div>
            <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
                <h2 class="text-lg font-bold text-on-surface">Upcoming Events Grid</h2>
                <div class="text-xs font-semibold text-on-surface-variant bg-surface-container-high px-3 py-1.5 rounded-full border border-outline-variant/60">
                    Showing {{ $events->firstItem() ?? 0 }}–{{ $events->lastItem() ?? 0 }} of {{ $events->total() }} events
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @forelse($events as $event)
                    <article class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm flex flex-col group hover:shadow-md transition-all">
                        <div class="h-40 w-full bg-surface-container-high flex items-center justify-center relative overflow-hidden">
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                            @else
                                <span class="material-symbols-outlined text-[40px] text-outline opacity-40">event</span>
                            @endif
                            <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur px-2.5 py-1 rounded-md border border-outline-variant/50 text-xs text-primary font-bold shadow-sm">
                                {{ $event->start_date->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-on-surface text-sm mb-1 group-hover:text-primary transition-colors line-clamp-1" title="{{ $event->name }}">{{ $event->name }}</h3>
                                <p class="text-xs text-on-surface-variant line-clamp-2 mb-3">{{ $event->description }}</p>
                            </div>
                            <a href="{{ route('events.show', $event) }}" class="block w-full py-2 bg-primary text-white text-center rounded-lg font-label-md text-xs font-semibold hover:bg-primary/90 transition-colors">
                                View Event Details
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-8 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                        No active events found.
                    </div>
                @endforelse
            </div>
            @if($events->hasPages())
                <div class="mt-8 pt-6 border-t border-outline-variant flex justify-center">
                    {{ $events->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </main>
</body>
</html>