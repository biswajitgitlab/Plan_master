<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Register: {{ $event->name }} - EventCentral</title>
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
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1000px] mx-auto w-full pb-24 md:pb-container-padding">
        <div class="pt-4 mb-6">
            <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold text-sm hover:underline">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Back to Upcoming Events
            </a>
        </div>

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

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
            @if($event->image_path)
                <div class="h-64 w-full relative bg-surface-variant overflow-hidden border-b border-outline-variant">
                    <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover"/>
                </div>
            @endif
            <div class="p-6 sm:p-8">
                <div class="border-b border-outline-variant pb-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="font-headline-lg text-2xl sm:text-3xl font-bold text-on-surface mb-2">{{ $event->name }}</h1>
                        <div class="flex flex-wrap gap-4 text-xs text-on-surface-variant font-medium">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                                {{ $event->start_date->format('M d, Y H:i') }} - {{ $event->end_date->format('M d, Y H:i') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                {{ $event->location ?? 'Virtual Location' }}
                            </span>
                        </div>
                    </div>
                    @php
                        $userRoleName = auth()->user()->getRoleNames()->first() ?? 'Employee';
                        $roleQuota = $event->quotas->where('role_name', $userRoleName)->first();
                        $roleRegsCount = $event->registrations->where('status', '!=', 'rejected')->filter(fn($r) => $r->user && $r->user->hasRole($userRoleName))->count();
                        $isFull = $roleQuota && $roleRegsCount >= $roleQuota->quota_limit;
                    @endphp
                    <div class="text-right bg-surface-container-low px-4 py-2 rounded-xl border border-outline-variant/60">
                        <div class="text-xs font-semibold text-on-surface-variant">Your Role: <span class="text-primary font-bold">{{ $userRoleName }}</span></div>
                        <div class="text-xs font-medium text-on-surface mt-0.5">
                            @if($roleQuota)
                                Quota: {{ $roleRegsCount }} / {{ $roleQuota->quota_limit }} filled
                            @else
                                Quota: Unlimited
                            @endif
                        </div>
                    </div>
                </div>
                <p class="text-sm text-on-surface-variant mt-4 leading-relaxed">{{ $event->description }}</p>
            </div>

            @if($registration)
                <!-- Existing Registration View -->
                <div class="space-y-6">
                    <div class="p-4 rounded-xl border {{ $registration->status === 'approved' ? 'bg-emerald-50 border-emerald-200 text-emerald-900' : ($registration->status === 'waitlisted' ? 'bg-amber-50 border-amber-200 text-amber-900' : ($registration->status === 'rejected' ? 'bg-error-container border-error/20 text-on-error-container' : 'bg-primary-fixed/40 border-primary-fixed text-on-primary-fixed-variant')) }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-2xl">
                                    {{ $registration->status === 'approved' ? 'verified' : ($registration->status === 'waitlisted' ? 'hourglass_empty' : ($registration->status === 'rejected' ? 'cancel' : 'pending')) }}
                                </span>
                                <div>
                                    <h3 class="font-bold text-base">Registration Status: {{ strtoupper($registration->status) }}</h3>
                                    <p class="text-xs mt-0.5 opacity-90">
                                        Submitted on {{ $registration->created_at->format('M d, Y H:i') }}
                                        @if($registration->status === 'pending')
                                            • Currently awaiting Level {{ $registration->current_approval_level }} approval
                                        @elseif($registration->status === 'waitlisted')
                                            • You are on the waitlist. You will be automatically promoted if a spot opens up.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Approval Bands Sequence Tracker -->
                    @if($event->approvalBands->count() > 0)
                        <div>
                            <h3 class="text-sm font-bold text-on-surface mb-3 uppercase tracking-wider">Approval Sequence Progress</h3>
                            <div class="space-y-3">
                                @foreach($event->approvalBands->sortBy('level_sequence') as $band)
                                    @php
                                        $isPassed = $registration->status === 'approved' || ($registration->status === 'pending' && $registration->current_approval_level > $band->level_sequence);
                                        $isCurrent = $registration->status === 'pending' && $registration->current_approval_level == $band->level_sequence;
                                    @endphp
                                    <div class="flex items-center gap-3 p-3 rounded-lg border {{ $isPassed ? 'bg-emerald-50 border-emerald-200' : ($isCurrent ? 'bg-primary-fixed/40 border-primary' : 'bg-surface-bright border-outline-variant') }}">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center font-bold text-xs {{ $isPassed ? 'bg-emerald-600 text-white' : ($isCurrent ? 'bg-primary text-white' : 'bg-surface-container-highest text-on-surface-variant') }}">
                                            {{ $band->level_sequence }}
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-on-surface">Level {{ $band->level_sequence }}: {{ $band->role_name }} Review</p>
                                            <p class="text-[11px] text-on-surface-variant">
                                                {{ $isPassed ? 'Approved' : ($isCurrent ? 'Awaiting Decision' : 'Upcoming Step') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- Registration Form -->
                <form action="{{ route('events.register', $event) }}" method="POST" class="space-y-6">
                    @csrf
                    <h2 class="text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        Complete Registration Form
                    </h2>

                    @if($isFull)
                        <div class="p-3 bg-amber-50 border border-amber-200 text-amber-800 rounded-lg text-xs font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600">warning</span>
                            Notice: The allocated quota for your role ({{ $userRoleName }}) is currently full. Submitting will place you on the official waitlist.
                        </div>
                    @endif

                    @php
                        $schema = is_array($event->form_schema) ? $event->form_schema : (json_decode($event->form_schema ?? '[]', true) ?: []);
                    @endphp

                    @if(count($schema) > 0)
                        @foreach($schema as $field)
                            @php
                                $fieldName = $field['name'] ?? ('field_'. $loop->index);
                                $fieldLabel = $field['label'] ?? ucfirst($fieldName);
                                $fieldType = $field['type'] ?? 'text';
                                $isRequired = !empty($field['required']);
                            @endphp
                            <div>
                                <label class="block font-label-md text-xs font-semibold text-on-surface mb-1">
                                    {{ $fieldLabel }} @if($isRequired)<span class="text-error">*</span>@endif
                                </label>
                                @if($fieldType === 'select' && isset($field['options']))
                                    <select name="form_data[{{ $fieldName }}]" @if($isRequired) required @endif class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                        <option value="">Select {{ $fieldLabel }}</option>
                                        @foreach($field['options'] as $opt)
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                @elseif($fieldType === 'textarea')
                                    <textarea name="form_data[{{ $fieldName }}]" rows="3" @if($isRequired) required @endif class="w-full p-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"></textarea>
                                @else
                                    <input type="{{ $fieldType }}" name="form_data[{{ $fieldName }}]" @if($isRequired) required @endif class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <!-- Default Standard Form Inputs -->
                        <div>
                            <label class="block font-label-md text-xs font-semibold text-on-surface mb-1">Department *</label>
                            <select name="form_data[department]" required class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                <option value="Engineering">Engineering</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Sales">Sales</option>
                                <option value="Design">Design</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-md text-xs font-semibold text-on-surface mb-1">Job Title</label>
                            <input type="text" name="form_data[job_title]" placeholder="e.g. Senior Specialist" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                        </div>
                        <div>
                            <label class="block font-label-md text-xs font-semibold text-on-surface mb-1">Dietary Requirements / Special Request</label>
                            <input type="text" name="form_data[dietary]" placeholder="e.g. Vegetarian, Wheelchair access" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-outline-variant flex justify-end">
                        <button type="submit" class="h-11 px-8 rounded-full bg-primary text-white font-label-md font-semibold hover:bg-primary/90 transition-colors shadow-sm">
                            {{ $isFull ? 'Submit & Join Waitlist' : 'Submit Registration Request' }}
                        </button>
                    </div>
                </form>
            @endif
            </div>
        </div>
    </main>
</body>
</html>