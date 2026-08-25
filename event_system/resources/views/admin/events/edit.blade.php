<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Event - EventCentral</title>
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
    <main class="flex-1 md:ml-72 flex flex-col min-h-screen">
        <div class="p-container-padding max-w-[1000px] w-full mx-auto pb-32 md:pb-stack-lg">
            <div class="mb-stack-lg flex items-center justify-between pt-4">
                <div class="flex items-center gap-4">
                    <a class="p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant inline-flex items-center justify-center" href="{{ route('admin.events.index') }}">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface">Edit Event: {{ $event->name }}</h1>
                        <p class="font-body-md text-on-surface-variant mt-1">Manage details, quotas, and tiered approval bands.</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl border border-error/20">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-8">
                <!-- Section 1: Basic Event Details -->
                <form class="bg-surface-container-lowest rounded-xl border border-outline-variant p-container-padding shadow-sm" method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="border-b border-outline-variant pb-4 mb-6">
                        <h2 class="font-headline-md text-lg font-semibold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">info</span>
                            Event Details
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                        <!-- Event Banner Image Upload -->
                        <div class="md:col-span-2">
                            <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5">Event Banner / Cover Image</label>
                            <div class="relative border-2 border-dashed border-outline-variant hover:border-primary rounded-xl p-4 bg-surface-container-low/40 flex flex-col items-center justify-center text-center transition-all cursor-pointer group" id="imageDropZone">
                                <input type="file" name="image" id="eventImageInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                                <div id="imagePreviewContainer" class="{{ $event->image_path ? '' : 'hidden' }} mb-2 relative w-full h-44 rounded-lg overflow-hidden border border-outline-variant">
                                    <img id="imagePreview" src="{{ $event->image_path ? asset('storage/' . $event->image_path) : '' }}" alt="Event Image Preview" class="w-full h-full object-cover"/>
                                    <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur text-white px-2.5 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">edit</span> Change Image
                                    </div>
                                </div>
                                <div id="imageUploadPlaceholder" class="{{ $event->image_path ? 'hidden' : '' }} flex flex-col items-center py-4">
                                    <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-2xl">add_photo_alternate</span>
                                    </div>
                                    <p class="text-xs font-bold text-on-surface">Click or drag an image here to upload</p>
                                    <p class="text-[11px] text-on-surface-variant mt-0.5">Supports PNG, JPG, WEBP or GIF (Max 5MB)</p>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-label-md text-on-surface mb-2" for="eventTitle">Event Title *</label>
                            <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" id="eventTitle" name="name" required value="{{ old('name', $event->name) }}" type="text"/>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-label-md text-on-surface mb-2" for="eventDesc">Description</label>
                            <textarea class="w-full p-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 resize-y" id="eventDesc" name="description" rows="3">{{ old('description', $event->description) }}</textarea>
                        </div>
                        <div>
                            <label class="block font-label-md text-on-surface mb-2" for="startDate">Start Date & Time *</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">calendar_today</span>
                                <input class="w-full h-10 pl-10 pr-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" id="startDate" name="start_date" required value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" type="datetime-local"/>
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-md text-on-surface mb-2" for="endDate">End Date & Time *</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">event</span>
                                <input class="w-full h-10 pl-10 pr-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" id="endDate" name="end_date" required value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}" type="datetime-local"/>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-label-md text-on-surface mb-2" for="location">Location</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">location_on</span>
                                <input class="w-full h-10 pl-10 pr-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" id="location" name="location" value="{{ old('location', $event->location) }}" placeholder="e.g. Auditorium A or Virtual Link" type="text"/>
                            </div>
                        </div>
                        
                        <!-- Visual Registration Form Builder -->
                        <div class="md:col-span-2 border-t border-outline-variant/60 pt-6 mt-2">
                            <div class="flex justify-between items-center flex-wrap gap-3 mb-4">
                                <div>
                                    <h3 class="font-label-md text-base font-bold text-on-surface flex items-center gap-2">
                                        <span class="material-symbols-outlined text-primary">tune</span>
                                        Dynamic Registration Form Builder
                                    </h3>
                                    <p class="text-xs text-on-surface-variant mt-0.5">Customize questions for registrants without writing any JSON.</p>
                                </div>
                                <button id="addFieldBtn" type="button" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-primary/10 text-primary border border-primary/20 hover:bg-primary hover:text-white rounded-full text-xs transition-all font-semibold">
                                    <span class="material-symbols-outlined text-[16px]">add_circle</span>
                                    + Add Question Field
                                </button>
                            </div>

                            <div id="visualFieldsContainer" class="space-y-3 mb-4">
                                <!-- Dynamic fields rendered by JS -->
                            </div>

                            <input type="hidden" name="form_schema" id="form_schema_hidden" value="{{ old('form_schema', is_string($event->form_schema) ? $event->form_schema : json_encode($event->form_schema)) }}">

                            <details class="mt-2">
                                <summary class="cursor-pointer text-xs font-medium text-on-surface-variant hover:text-primary transition-colors inline-flex items-center gap-1 select-none">
                                    <span class="material-symbols-outlined text-[14px]">code</span>
                                    Advanced: View Generated JSON Data
                                </summary>
                                <div class="mt-2">
                                    <textarea id="rawJsonTextarea" class="w-full p-2.5 font-mono text-xs rounded-md border border-outline-variant bg-surface-container-low text-on-surface focus:outline-none" rows="3" readonly></textarea>
                                </div>
                            </details>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button class="h-10 px-6 rounded-full bg-primary text-white font-label-md hover:bg-primary/90 transition-colors shadow-sm" type="submit">
                            Update Event Details
                        </button>
                    </div>
                </form>

                <!-- Section 2: Quota Management -->
                <section class="bg-surface-container-lowest rounded-xl border border-outline-variant p-container-padding shadow-sm">
                    <div class="border-b border-outline-variant pb-4 mb-6 flex justify-between items-center">
                        <h2 class="font-headline-md text-lg font-semibold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">groups</span>
                            Quota Allocations
                        </h2>
                        <span class="text-sm font-semibold bg-surface-container-low px-3 py-1 rounded-full text-on-surface-variant">
                            Total Defined Capacity: {{ $event->quotas->sum('quota_limit') }}
                        </span>
                    </div>

                    <!-- Existing Quotas List -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        @forelse($event->quotas as $quota)
                            <div class="border border-outline-variant rounded-lg p-4 bg-surface-bright flex justify-between items-center">
                                <div>
                                    <div class="font-label-md text-sm text-on-surface font-semibold">{{ $quota->role_name }}</div>
                                    <div class="text-xs text-on-surface-variant">Limit: {{ $quota->quota_limit }} spots</div>
                                </div>
                                <form action="{{ route('admin.quotas.destroy', $quota) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-outline hover:text-error transition-colors p-1.5 rounded-full hover:bg-error-container" title="Delete Quota">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-sm text-on-surface-variant col-span-3 italic">No quotas configured for this event yet.</p>
                        @endforelse
                    </div>

                    <!-- Add New Quota Form -->
                    <form action="{{ route('admin.events.quotas.store', $event) }}" method="POST" class="pt-4 border-t border-outline-variant/60 flex flex-col sm:flex-row items-end gap-4">
                        @csrf
                        <div class="flex-1 w-full">
                            <label class="block font-label-md text-xs text-on-surface mb-1">Target Role</label>
                            <select name="role_name" required class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                <option value="Employee">Employee</option>
                                <option value="Manager">Manager</option>
                                <option value="External">External / Guest</option>
                                <option value="VIP">VIP</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-40">
                            <label class="block font-label-md text-xs text-on-surface mb-1">Quota Limit</label>
                            <input type="number" min="1" required name="quota_limit" placeholder="e.g. 50" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                        </div>
                        <button type="submit" class="h-10 px-5 rounded-full border border-primary text-primary hover:bg-primary/10 transition-colors text-sm font-semibold whitespace-nowrap">
                            + Add Quota
                        </button>
                    </form>
                </section>

                <!-- Section 3: Approval Bands Workflow -->
                <section class="bg-surface-container-lowest rounded-xl border border-outline-variant p-container-padding shadow-sm">
                    <div class="border-b border-outline-variant pb-4 mb-6">
                        <h2 class="font-headline-md text-lg font-semibold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">verified_user</span>
                            Approval Workflow Bands
                        </h2>
                    </div>

                    <!-- Existing Bands -->
                    <div class="space-y-3 mb-6">
                        @forelse($event->approvalBands->sortBy('level_sequence') as $band)
                            <div class="flex items-center gap-4 bg-surface-bright border border-outline-variant rounded-lg p-3">
                                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm">
                                    {{ $band->level_sequence }}
                                </div>
                                <div class="flex-1 font-semibold text-on-surface">
                                    Level {{ $band->level_sequence }}: {{ $band->role_name }} Approval
                                </div>
                                <form action="{{ route('admin.approval-bands.destroy', $band) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-outline hover:text-error transition-colors p-1.5 rounded-full hover:bg-error-container" title="Remove Step">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-sm text-on-surface-variant italic">No approval bands configured. Registrations will remain pending without level approvals.</p>
                        @endforelse
                    </div>

                    <!-- Add New Band Form -->
                    <form action="{{ route('admin.events.approval-bands.store', $event) }}" method="POST" class="pt-4 border-t border-outline-variant/60 flex flex-col sm:flex-row items-end gap-4">
                        @csrf
                        <div class="w-full sm:w-32">
                            <label class="block font-label-md text-xs text-on-surface mb-1">Sequence</label>
                            <input type="number" min="1" required name="level_sequence" value="{{ ($event->approvalBands->max('level_sequence') ?? 0) + 1 }}" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block font-label-md text-xs text-on-surface mb-1">Approver Role</label>
                            <select name="role_name" required class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                <option value="Manager">Manager</option>
                                <option value="Sub-Admin">Sub-Admin</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="h-10 px-5 rounded-full border border-primary text-primary hover:bg-primary/10 transition-colors text-sm font-semibold whitespace-nowrap">
                            + Add Band Level
                        </button>
                    </form>
                </section>
            </div>
        </div>
    </main>
    <script>
        // Visual Dynamic Form Builder Logic (Non-Tech Friendly)
        (function() {
            const hiddenInput = document.getElementById('form_schema_hidden');
            const container = document.getElementById('visualFieldsContainer');
            const addBtn = document.getElementById('addFieldBtn');
            const rawJsonTextarea = document.getElementById('rawJsonTextarea');

            if (!hiddenInput || !container || !addBtn) return;

            let initialData = [];
            try {
                initialData = JSON.parse(hiddenInput.value || '[]');
            } catch(e) {
                initialData = [
                    { name: 'department', label: 'Department', type: 'select', required: true, options: ['Engineering', 'HR', 'Marketing', 'Sales', 'Design'] },
                    { name: 'dietary', label: 'Dietary Requirements', type: 'text', required: false }
                ];
            }

            if (!Array.isArray(initialData) || initialData.length === 0) {
                initialData = [
                    { name: 'department', label: 'Department', type: 'select', required: true, options: ['Engineering', 'HR', 'Marketing', 'Sales', 'Design'] },
                    { name: 'dietary', label: 'Dietary Requirements', type: 'text', required: false }
                ];
            }

            function sanitizeName(str) {
                return (str || '').toLowerCase().trim().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '') || 'field';
            }

            function syncSchema() {
                const fieldCards = container.querySelectorAll('.form-field-card');
                const schema = [];

                fieldCards.forEach((card, index) => {
                    const labelInput = card.querySelector('.field-label');
                    const typeSelect = card.querySelector('.field-type');
                    const reqCheckbox = card.querySelector('.field-required');
                    const optionsInput = card.querySelector('.field-options');

                    const label = labelInput ? labelInput.value.trim() : `Question ${index + 1}`;
                    const type = typeSelect ? typeSelect.value : 'text';
                    const required = reqCheckbox ? reqCheckbox.checked : false;

                    const fieldObj = {
                        name: sanitizeName(label) || `field_${index + 1}`,
                        label: label || `Question ${index + 1}`,
                        type: type,
                        required: required
                    };

                    if (type === 'select' && optionsInput) {
                        const rawOptions = optionsInput.value;
                        const optsArray = rawOptions.split(',').map(s => s.trim()).filter(Boolean);
                        fieldObj.options = optsArray.length > 0 ? optsArray : ['Option 1', 'Option 2'];
                    }

                    schema.push(fieldObj);
                });

                const jsonString = JSON.stringify(schema);
                hiddenInput.value = jsonString;
                if (rawJsonTextarea) {
                    rawJsonTextarea.value = JSON.stringify(schema, null, 2);
                }
            }

            function renderFieldCard(field = {}) {
                const card = document.createElement('div');
                card.className = 'form-field-card bg-surface-bright border border-outline-variant rounded-xl p-4 transition-all hover:border-primary/50 relative group shadow-sm';
                
                const type = field.type || 'text';
                const label = field.label || '';
                const required = field.required !== false;
                const optionsStr = Array.isArray(field.options) ? field.options.join(', ') : (field.options || '');

                card.innerHTML = `
                    <div class="flex items-center justify-between gap-3 mb-3 pb-2 border-b border-outline-variant/60">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-outline cursor-grab">drag_indicator</span>
                            <span class="font-label-md text-xs font-bold text-primary uppercase tracking-wider">Question Field</span>
                        </div>
                        <button type="button" class="remove-field-btn text-on-surface-variant hover:text-error transition-colors p-1 rounded-full hover:bg-error-container" title="Delete Question">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-5">
                            <label class="block font-label-md text-xs font-semibold text-on-surface mb-1">Question Label *</label>
                            <input type="text" class="field-label w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary" placeholder="e.g., Department or T-Shirt Size" value="${escapeHtml(label)}"/>
                        </div>

                        <div class="md:col-span-4">
                            <label class="block font-label-md text-xs font-semibold text-on-surface mb-1">Answer Type</label>
                            <select class="field-type w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                <option value="text" ${type === 'text' ? 'selected' : ''}>Short Text</option>
                                <option value="select" ${type === 'select' ? 'selected' : ''}>Dropdown Select</option>
                                <option value="textarea" ${type === 'textarea' ? 'selected' : ''}>Long Text Area</option>
                                <option value="number" ${type === 'number' ? 'selected' : ''}>Number Input</option>
                            </select>
                        </div>

                        <div class="md:col-span-3 flex items-center pt-5">
                            <label class="inline-flex items-center gap-2 cursor-pointer select-none text-xs font-semibold text-on-surface">
                                <input type="checkbox" class="field-required rounded border-outline-variant text-primary focus:ring-primary h-4 w-4" ${required ? 'checked' : ''}/>
                                <span>Mandatory Question</span>
                            </label>
                        </div>

                        <!-- Dropdown Options (Conditional) -->
                        <div class="options-wrapper md:col-span-12 ${type === 'select' ? '' : 'hidden'}">
                            <label class="block font-label-md text-xs font-semibold text-primary mb-1">
                                Dropdown Choices (separate choices with commas) *
                            </label>
                            <input type="text" class="field-options w-full h-10 px-3 rounded-md border border-primary/40 bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary" placeholder="e.g. Engineering, HR, Marketing, Sales, Design" value="${escapeHtml(optionsStr)}"/>
                            <span class="text-[11px] text-on-surface-variant mt-1 block">Registrants will select one of these options during sign-up.</span>
                        </div>
                    </div>
                `;

                container.appendChild(card);

                const labelInput = card.querySelector('.field-label');
                const typeSelect = card.querySelector('.field-type');
                const reqCheck = card.querySelector('.field-required');
                const optsInput = card.querySelector('.field-options');
                const optsWrapper = card.querySelector('.options-wrapper');
                const deleteBtn = card.querySelector('.remove-field-btn');

                typeSelect.addEventListener('change', () => {
                    if (typeSelect.value === 'select') {
                        optsWrapper.classList.remove('hidden');
                    } else {
                        optsWrapper.classList.add('hidden');
                    }
                    syncSchema();
                });

                labelInput.addEventListener('input', syncSchema);
                reqCheck.addEventListener('change', syncSchema);
                if (optsInput) optsInput.addEventListener('input', syncSchema);

                deleteBtn.addEventListener('click', () => {
                    if (container.querySelectorAll('.form-field-card').length > 1) {
                        card.remove();
                        syncSchema();
                    } else {
                        alert('Form must have at least one question field.');
                    }
                });

                syncSchema();
            }

            function escapeHtml(str) {
                return (str || '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }

            container.innerHTML = '';
            initialData.forEach(f => renderFieldCard(f));

            addBtn.addEventListener('click', () => {
                renderFieldCard({ label: 'New Question', type: 'text', required: false, options: [] });
            });
        })();

        // Image Preview Handler
        const eventImageInput = document.getElementById('eventImageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imageUploadPlaceholder = document.getElementById('imageUploadPlaceholder');

        if (eventImageInput && imagePreview && imagePreviewContainer && imageUploadPlaceholder) {
            eventImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                        imagePreviewContainer.classList.remove('hidden');
                        imageUploadPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html>