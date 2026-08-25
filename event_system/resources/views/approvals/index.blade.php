<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Approvals Dashboard - EventCentral</title>
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
                        "error-container": "#ffdad6"
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
                    <span class="font-label-md text-on-surface">{{ auth()->user()->name ?? 'User' }}</span>
                    <span class="text-xs text-on-surface-variant">{{ auth()->user()->getRoleNames()->first() ?? 'Approver' }}</span>
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
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('events.index') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="font-label-md">Events</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="{{ route('approvals.index') }}">
                <span class="material-symbols-outlined" data-weight="fill">fact_check</span>
                <span>Approvals</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] mx-auto w-full pb-24 md:pb-container-padding">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-stack-lg gap-4 pt-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Approvals Dashboard</h1>
                <p class="font-body-md text-on-surface-variant">Review and process registration requests requiring your role approval level.</p>
            </div>
            <div class="flex items-center gap-2 bg-surface-container-low border border-outline-variant px-4 py-2 rounded-full">
                <span class="material-symbols-outlined text-primary">pending_actions</span>
                <span class="font-label-md text-on-surface font-semibold">{{ method_exists($registrations, 'total') ? $registrations->total() : count($registrations) }} Registrations</span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter tabs -->
        <div class="flex flex-wrap gap-2 mb-6 border-b border-outline-variant pb-3">
            <a href="{{ route('approvals.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-full text-xs font-semibold {{ request('status', 'pending') === 'pending' ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
                Pending Review
            </a>
            <a href="{{ route('approvals.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-full text-xs font-semibold {{ request('status') === 'approved' ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
                Approved
            </a>
            <a href="{{ route('approvals.index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-full text-xs font-semibold {{ request('status') === 'rejected' ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
                Rejected
            </a>
            <a href="{{ route('approvals.index', ['status' => 'waitlisted']) }}" class="px-4 py-2 rounded-full text-xs font-semibold {{ request('status') === 'waitlisted' ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
                Waitlisted
            </a>
            <a href="{{ route('approvals.index', ['status' => 'all']) }}" class="px-4 py-2 rounded-full text-xs font-semibold {{ request('status') === 'all' ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
                All Records
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-stack-md">
            @forelse($registrations as $registration)
                @php
                    $applicant = $registration->user;
                    $initials = strtoupper(substr($applicant->name ?? 'U', 0, 2));
                    $userRole = $applicant ? ($applicant->getRoleNames()->first() ?? 'Participant') : 'Participant';
                    $formData = is_array($registration->form_data) ? $registration->form_data : (json_decode($registration->form_data ?? '', true) ?: []);
                @endphp
                <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-wrap justify-between items-center gap-2 border-b border-outline-variant/50 bg-surface-bright">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm flex-shrink-0">
                                {{ $initials }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-bold text-on-surface text-base truncate">{{ $applicant->name ?? 'Unknown User' }}</h3>
                                <p class="text-xs text-on-surface-variant truncate">{{ $applicant->email ?? 'N/A' }} • <span class="font-semibold text-primary">{{ $userRole }}</span></p>
                            </div>
                        </div>
                        @if($registration->status === 'pending')
                            <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full font-label-md text-xs border border-amber-200 font-semibold flex-shrink-0">
                                Pending (Lvl {{ $registration->current_approval_level }})
                            </span>
                        @elseif($registration->status === 'approved')
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full font-label-md text-xs border border-emerald-200 font-semibold flex-shrink-0">
                                Fully Approved
                            </span>
                        @elseif($registration->status === 'rejected')
                            <span class="px-3 py-1 bg-error-container text-on-error-container rounded-full font-label-md text-xs font-semibold flex-shrink-0">
                                Rejected
                            </span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full font-label-md text-xs border border-gray-300 font-semibold flex-shrink-0">
                                Waitlisted
                            </span>
                        @endif
                    </div>

                    <div class="p-4 flex-1 space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="min-w-0">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Event Name</p>
                                <p class="text-sm text-on-surface font-semibold truncate" title="{{ $registration->event->name ?? 'N/A' }}">{{ $registration->event->name ?? 'N/A' }}</p>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Submission Date</p>
                                <p class="text-sm text-on-surface">{{ $registration->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>

                        @if(!empty($formData))
                            <div class="bg-surface-container-low p-3 rounded-lg border border-outline-variant/40">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Form Responses</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                    @foreach($formData as $key => $val)
                                        <div class="min-w-0">
                                            <span class="font-semibold text-on-surface-variant">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                            <span class="text-on-surface break-words">{{ is_array($val) ? implode(', ', $val) : $val }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($registration->approvals && $registration->approvals->count() > 0)
                            <div class="pt-2 border-t border-outline-variant/30 text-xs">
                                <span class="font-semibold text-on-surface-variant">Approval Log:</span>
                                @foreach($registration->approvals as $audit)
                                    <div class="text-[11px] text-on-surface-variant mt-0.5 break-words">
                                        • {{ ucfirst($audit->status) }} by {{ $audit->approver->name ?? 'Approver' }} @if($audit->comments) ( "{{ $audit->comments }}" ) @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($registration->status === 'pending')
                        <form method="POST" class="p-4 bg-surface-container-low/40 border-t border-outline-variant/50 space-y-3">
                            @csrf
                            <input type="text" name="comments" placeholder="Add approval or rejection note (optional)..." class="w-full text-xs px-3.5 py-2 border border-outline-variant rounded-lg bg-surface-container-lowest focus:outline-none focus:border-primary shadow-sm"/>
                            <div class="flex items-center justify-end gap-2">
                                <button type="submit" formaction="{{ route('approvals.reject', $registration) }}" class="px-4 py-2 bg-surface-container-lowest border border-error/50 text-error hover:bg-error-container/20 transition-colors rounded-lg text-xs font-semibold flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">close</span> Reject
                                </button>
                                <button type="submit" formaction="{{ route('approvals.approve', $registration) }}" class="px-5 py-2 bg-emerald-600 text-white hover:bg-emerald-700 transition-colors rounded-lg text-xs font-semibold flex items-center justify-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">check</span> Approve
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">task_alt</span>
                    <p class="font-medium">No registrations matching this filter.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($registrations, 'links'))
            <div class="mt-6">
                {{ $registrations->links() }}
            </div>
        @endif
    </main>
</body>
</html>