<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EventCentral - Browse Events</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed": "#d8e2ff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-tertiary-fixed": "#341100",
                        "tertiary-fixed-dim": "#ffb691",
                        "surface-container": "#eceef0",
                        "surface-container-high": "#e6e8ea",
                        "primary-container": "#1a73e8",
                        "surface-container-low": "#f2f4f6",
                        "on-primary-fixed-variant": "#004493",
                        "error-container": "#ffdad6",
                        "on-surface": "#191c1e",
                        "primary-fixed-dim": "#adc7ff",
                        "on-surface-variant": "#414754",
                        "secondary-fixed": "#d5e3fc",
                        "inverse-surface": "#2d3133",
                        "inverse-on-surface": "#eff1f3",
                        "on-secondary": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "secondary-container": "#d5e3fc",
                        "tertiary": "#9e4300",
                        "on-background": "#191c1e",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#adc7ff",
                        "primary": "#005bbf",
                        "on-secondary-container": "#57657a",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-bright": "#f7f9fb",
                        "background": "#f7f9fb",
                        "surface-container-highest": "#e0e3e5",
                        "outline-variant": "#c1c6d6",
                        "on-tertiary-fixed-variant": "#783100",
                        "on-tertiary-container": "#0e0200",
                        "on-error": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#ffffff",
                        "tertiary-fixed": "#ffdbcb",
                        "outline": "#727785",
                        "on-primary-fixed": "#001a41",
                        "secondary": "#515f74",
                        "on-secondary-fixed": "#0d1c2e",
                        "tertiary-container": "#c55500",
                        "on-primary": "#ffffff",
                        "surface-dim": "#d8dadc",
                        "on-tertiary": "#ffffff",
                        "surface-tint": "#005bc0",
                        "surface": "#f7f9fb",
                        "error": "#ba1a1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "container-padding": "24px",
                        "stack-sm": "8px",
                        "gutter": "16px",
                        "unit": "4px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "label-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-lg": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-[#f8fafc] text-on-background antialiased min-h-screen flex flex-col md:flex-row bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] relative overflow-x-hidden">
    <!-- Ambient Background Glow Orbs -->
    <div class="fixed top-0 right-0 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed bottom-0 left-72 w-[500px] h-[500px] bg-primary-container/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

<!-- Mobile Top App Bar -->
<header class="md:hidden flex justify-between items-center px-container-padding h-16 w-full max-w-[1440px] mx-auto bg-surface-container-lowest/90 backdrop-blur-md border-b border-outline-variant shadow-sm w-full top-0 sticky z-40">
<div class="flex items-center gap-stack-sm">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">event_available</span>
<span class="font-headline-md text-headline-md font-bold text-primary">EventCentral</span>
</div>
<div class="h-8 w-8 rounded-full overflow-hidden bg-surface-container-highest cursor-pointer hover:bg-surface-container-low transition-colors active:opacity-80">
<img alt="Profile Picture" class="w-full h-full object-cover" data-alt="A professional headshot of a corporate employee on a white background, well-lit, representing the current logged-in user profile picture." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlC-wK6W3AQt6RxaDuJDEzaaUxBMHwzLb0g8HOD6VHcRQvprGU8_XNBYz0y-acVi03jtYUhiAjruuEnWukeUcmctRnPG8WdNL7mBCWcb8X9x06g2UgbnkBPgO39R_iLhA2JC94Nw9Udx-acncEarBUl0475Alil1NPIKgU9ZgU2qRCm2cLoeEX3TuXefD8j5SUZhfvcqpymVYjlJEZA29XuuPQ5uJApGveHP7yyYBPBOMaEY-MC0--"/>
</div>
</header>
<!-- Desktop SideNav -->
<nav class="hidden md:flex flex-col h-full w-72 fixed left-0 top-0 bg-surface-container/90 backdrop-blur-xl p-4 gap-stack-sm z-40 border-r border-outline-variant/60 shadow-sm">
<div class="flex items-center gap-stack-sm mb-stack-md px-4 pt-2">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">event_available</span>
<span class="font-headline-md text-headline-md font-bold text-primary">EventCentral</span>
</div>

@auth
<div class="flex items-center justify-between px-4 py-3 mb-stack-md bg-surface-container-high rounded-lg">
<div class="flex items-center gap-3">
<div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold">
{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
</div>
<div class="flex flex-col">
<span class="font-label-md text-on-surface">{{ auth()->user()->name }}</span>
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
<div class="flex flex-col gap-unit">
<a class="flex items-center gap-stack-md px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all font-label-md" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
<a class="flex items-center gap-stack-md px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="{{ route('events.index') }}">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">calendar_month</span>
                Events
            </a>
@if(auth()->user()->hasAnyRole(['Admin', 'Sub-Admin', 'Manager']))
<a class="flex items-center gap-stack-md px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all font-label-md" href="{{ route('approvals.index') }}">
<span class="material-symbols-outlined">fact_check</span>
                Approvals
            </a>
@endif
</div>
@else
<div class="p-4 bg-surface-container-high rounded-lg mb-4 text-center">
<p class="text-xs text-on-surface-variant mb-3 font-medium">Sign in to register for events & track approval status.</p>
<div class="flex flex-col gap-2">
<a href="{{ route('login') }}" class="w-full py-2 bg-primary text-white text-center rounded-lg font-label-md font-semibold hover:bg-primary/90 transition-colors">Sign In</a>
<a href="{{ route('register') }}" class="w-full py-2 bg-surface-container-lowest border border-outline-variant text-on-surface text-center rounded-lg font-label-md font-semibold hover:bg-surface-container-low transition-colors">Create Account</a>
</div>
</div>
@endauth
</nav>

<!-- Main Content Area -->
<main class="flex-1 w-full max-w-[1440px] mx-auto md:ml-72 pb-24 md:pb-8 pt-stack-md px-gutter md:px-container-padding">
<header class="mb-stack-md pt-stack-md">
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-stack-sm">Upcoming Corporate Events</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Browse and register for upcoming workshops, summits, and executive sessions.</p>
</header>

<!-- Search Bar & Statistics Header -->
<div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <form method="GET" action="{{ route('events.index') }}" class="relative flex-1 max-w-md">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events by title, location, or topic..." class="w-full h-11 pl-10 pr-10 rounded-full border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary shadow-sm"/>
        @if(request('search'))
            <a href="{{ route('events.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error" title="Clear Search">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </a>
        @endif
    </form>
    <div class="text-xs font-semibold text-on-surface-variant bg-surface-container-high px-4 py-2 rounded-full border border-outline-variant/60">
        Showing {{ $events->firstItem() ?? 0 }}–{{ $events->lastItem() ?? 0 }} of {{ $events->total() }} events
    </div>
</div>

<!-- Event Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
    @forelse($events as $event)
    <!-- Event Card -->
    <article class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-[0_1px_3px_rgba(0,0,0,0.05)] flex flex-col group hover:shadow-md transition-shadow">
        <div class="h-44 w-full relative bg-surface-variant flex items-center justify-center overflow-hidden">
            @if($event->image_path)
                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
            @else
                <span class="material-symbols-outlined text-[48px] text-on-surface-variant opacity-20">event</span>
            @endif
            <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur px-2 py-1 rounded-md border border-outline-variant/50">
                <span class="font-label-md text-label-md text-primary flex items-center gap-1 font-semibold">
                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                    {{ $event->start_date->format('M d, Y') }}
                </span>
            </div>
        </div>
        <div class="p-4 flex-1 flex flex-col">
            <div class="flex justify-between items-start mb-2">
                <h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors line-clamp-1" title="{{ $event->name }}">{{ $event->name }}</h3>
                <span class="inline-flex items-center px-2 py-1 bg-primary-fixed text-on-primary-fixed-variant rounded-full font-label-md text-[10px] uppercase tracking-wider font-semibold">
                    Available
                </span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant mb-4 flex-1 line-clamp-3">{{ $event->description }}</p>
            <div class="flex items-center gap-2 mb-4 text-on-surface-variant font-medium">
                <span class="material-symbols-outlined text-[16px]">location_on</span>
                <span class="font-body-md text-body-md text-sm truncate">{{ $event->location ?? 'Virtual Platform' }}</span>
            </div>
            <div class="pt-4 border-t border-outline-variant/50 mt-auto">
                @auth
                    <a href="{{ route('events.show', $event) }}" class="block w-full py-2 bg-primary text-white text-center rounded-lg font-label-md font-semibold hover:bg-primary/90 transition-colors">
                        Register Now
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block w-full py-2 bg-primary text-white text-center rounded-lg font-label-md font-semibold hover:bg-primary/90 transition-colors">
                        Sign In to Register
                    </a>
                @endauth
            </div>
        </div>
    </article>
    @empty
    <div class="col-span-full py-16 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
        <span class="material-symbols-outlined text-4xl text-on-surface-variant/40 mb-2">event_busy</span>
        <p class="font-semibold text-on-surface">No matching events found</p>
        <p class="text-xs text-on-surface-variant mt-1">Try clearing your search query or adjusting filters.</p>
    </div>
    @endforelse
</div>

<!-- Pagination Links -->
@if($events->hasPages())
    <div class="mt-8 pt-6 border-t border-outline-variant flex justify-center">
        {{ $events->appends(request()->query())->links() }}
    </div>
@endif
</main>
</body></html>