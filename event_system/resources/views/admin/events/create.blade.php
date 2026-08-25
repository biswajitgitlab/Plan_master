<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Create Event - Admin</title>
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
                <button type="submit" title="Logout" class="text-on-surface-variant hover:text-error transition-colors p-1">
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
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1000px] w-full mx-auto pb-24 md:pb-container-padding">
        <!-- Top App Bar (Mobile) -->
        <header class="md:hidden flex justify-between items-center mb-6 py-2 border-b border-outline-variant">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" data-weight="fill">event_available</span>
                <span class="font-headline-md font-bold text-primary">EventCentral</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
        </header>

        <div class="flex items-center gap-4 mb-stack-lg pt-4">
            <a href="{{ route('admin.events.index') }}" class="w-9 h-9 rounded-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center text-on-surface-variant hover:text-primary hover:border-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Create New Event</h1>
                <p class="font-body-md text-on-surface-variant">Configure event details, capacity quotas, and approval workflows.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl border border-error/20">
                <ul class="list-disc list-inside space-y-1 text-xs font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="space-y-6" method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Section 1: Event Details -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
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
                            <div id="imagePreviewContainer" class="hidden mb-2 relative w-full h-44 rounded-lg overflow-hidden border border-outline-variant">
                                <img id="imagePreview" src="" alt="Event Image Preview" class="w-full h-full object-cover"/>
                                <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur text-white px-2.5 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">edit</span> Change Image
                                </div>
                            </div>
                            <div id="imageUploadPlaceholder" class="flex flex-col items-center py-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">add_photo_alternate</span>
                                </div>
                                <p class="text-xs font-bold text-on-surface">Click or drag an image here to upload</p>
                                <p class="text-[11px] text-on-surface-variant mt-0.5">Supports PNG, JPG, WEBP or GIF (Max 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="eventTitle">Event Title *</label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" id="eventTitle" name="name" required value="{{ old('name') }}" placeholder="e.g., Annual Tech Summit 2026" type="text"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="eventDesc">Description</label>
                        <textarea class="w-full p-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-y" id="eventDesc" name="description" placeholder="Provide a detailed description of the event..." rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="startDate">Start Date & Time *</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">calendar_today</span>
                            <input class="w-full h-10 pl-10 pr-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" id="startDate" name="start_date" required value="{{ old('start_date') }}" type="datetime-local"/>
                        </div>
                    </div>
                    <div>
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="endDate">End Date & Time *</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">event</span>
                            <input class="w-full h-10 pl-10 pr-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" id="endDate" name="end_date" required value="{{ old('end_date') }}" type="datetime-local"/>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="location">Location</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">location_on</span>
                            <input class="w-full h-10 pl-10 pr-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" id="location" name="location" value="{{ old('location') }}" placeholder="Building A, Auditorium 101 or Virtual Meeting Link" type="text"/>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 2: Quota Management -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6 flex justify-between items-center flex-wrap gap-2">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">groups</span>
                        Quota Management
                    </h2>
                    <div class="flex items-center gap-2 bg-surface-container-low px-3 py-1.5 rounded-full border border-outline-variant/60">
                        <span class="font-label-md text-xs font-semibold text-on-surface-variant">Total Capacity:</span>
                        <span class="font-body-md text-sm font-bold text-primary" id="totalCapacity">0</span>
                    </div>
                </div>
                <p class="text-xs text-on-surface-variant mb-6">Define participant limits based on organizational roles. Leave blank for unlimited.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Employee Quota -->
                    <div class="border border-outline-variant rounded-xl p-4 bg-surface-container-low/50 hover:border-primary transition-colors focus-within:border-primary">
                        <label class="flex items-center gap-2 font-label-md text-xs font-bold text-on-surface mb-2" for="quotaEmployee">
                            <span class="material-symbols-outlined text-primary text-[18px]">badge</span>
                            Employee
                        </label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary quota-input" id="quotaEmployee" name="quotas[Employee]" min="0" placeholder="e.g., 50" type="number" value="{{ old('quotas.Employee') }}"/>
                    </div>
                    <!-- External Quota -->
                    <div class="border border-outline-variant rounded-xl p-4 bg-surface-container-low/50 hover:border-primary transition-colors focus-within:border-primary">
                        <label class="flex items-center gap-2 font-label-md text-xs font-bold text-on-surface mb-2" for="quotaExternal">
                            <span class="material-symbols-outlined text-primary text-[18px]">public</span>
                            External
                        </label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary quota-input" id="quotaExternal" name="quotas[External]" min="0" placeholder="e.g., 20" type="number" value="{{ old('quotas.External') }}"/>
                    </div>
                    <!-- Manager Quota -->
                    <div class="border border-outline-variant rounded-xl p-4 bg-surface-container-low/50 hover:border-primary transition-colors focus-within:border-primary">
                        <label class="flex items-center gap-2 font-label-md text-xs font-bold text-on-surface mb-2" for="quotaManager">
                            <span class="material-symbols-outlined text-primary text-[18px]">manage_accounts</span>
                            Manager
                        </label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary quota-input" id="quotaManager" name="quotas[Manager]" min="0" placeholder="e.g., 10" type="number" value="{{ old('quotas.Manager') }}"/>
                    </div>
                </div>
            </section>

            <!-- Section 3: Approval Workflow -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6 flex justify-between items-center">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">verified_user</span>
                        Approval Workflow
                    </h2>
                    <button id="addApprovalStepBtn" class="text-xs font-semibold text-primary bg-primary/10 border border-primary/20 hover:bg-primary hover:text-white px-3.5 py-1.5 rounded-full transition-all flex items-center gap-1" type="button">
                        <span class="material-symbols-outlined text-[16px]">add</span>
                        Add Step
                    </button>
                </div>
                <p class="text-xs text-on-surface-variant mb-6">Set the sequence of approvers for this event.</p>
                <div class="space-y-3" id="approvalStepsContainer">
                    <!-- Step 1 -->
                    <div class="approval-step flex items-center gap-3 bg-surface-container-low/50 border border-outline-variant rounded-xl p-3">
                        <span class="material-symbols-outlined text-outline cursor-grab">drag_indicator</span>
                        <div class="step-num w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs">1</div>
                        <div class="flex-1">
                            <select name="approval_bands[]" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                <option value="Direct Manager">Direct Manager</option>
                                <option value="Manager" selected>Manager / Department Head</option>
                                <option value="Finance Director">Finance Director</option>
                                <option value="Security Officer">Security Officer</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <button class="remove-step-btn text-on-surface-variant hover:text-error transition-colors p-2 rounded-full hover:bg-error-container" type="button">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>
                    <!-- Step 2 -->
                    <div class="approval-step flex items-center gap-3 bg-surface-container-low/50 border border-outline-variant rounded-xl p-3">
                        <span class="material-symbols-outlined text-outline cursor-grab">drag_indicator</span>
                        <div class="step-num w-8 h-8 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-bold text-xs">2</div>
                        <div class="flex-1">
                            <select name="approval_bands[]" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                <option value="Direct Manager">Direct Manager</option>
                                <option value="Manager">Manager / Department Head</option>
                                <option value="Finance Director" selected>Finance Director</option>
                                <option value="Security Officer">Security Officer</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <button class="remove-step-btn text-on-surface-variant hover:text-error transition-colors p-2 rounded-full hover:bg-error-container" type="button">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>
                </div>
            </section>

            <!-- Section 4: Visual Dynamic Registration Form Builder -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6 flex justify-between items-center flex-wrap gap-3">
                    <div>
                        <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">tune</span>
                            Dynamic Registration Form Builder
                        </h2>
                        <p class="text-xs text-on-surface-variant mt-1">
                            Customize questions for registrants without writing any JSON.
                        </p>
                    </div>
                    <button id="addFieldBtn" type="button" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-primary/10 text-primary border border-primary/20 hover:bg-primary hover:text-white rounded-full text-xs transition-all font-semibold">
                        <span class="material-symbols-outlined text-[16px]">add_circle</span>
                        + Add Question Field
                    </button>
                </div>

                <!-- Visual Field Cards Container -->
                <div id="visualFieldsContainer" class="space-y-4 mb-4">
                    <!-- Dynamic visual field rows will be rendered here by JS -->
                </div>

                <!-- Hidden Input for Backend Submission -->
                <input type="hidden" name="form_schema" id="form_schema_hidden" value="{{ old('form_schema', '[{"name": "department", "label": "Department", "type": "select", "required": true, "options": ["Engineering", "HR", "Marketing", "Sales", "Design"]}, {"name": "dietary", "label": "Dietary Requirements", "type": "text", "required": false}]') }}">

                <!-- Collapsible Advanced JSON Viewer for Power Users -->
                <details class="mt-4 pt-4 border-t border-outline-variant/60">
                    <summary class="cursor-pointer text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors inline-flex items-center gap-1 select-none">
                        <span class="material-symbols-outlined text-[16px]">code</span>
                        Advanced: View Generated JSON Data
                    </summary>
                    <div class="mt-3">
                        <textarea id="rawJsonTextarea" class="w-full p-3 font-mono text-xs rounded-md border border-outline-variant bg-surface-container-low text-on-surface focus:outline-none" rows="4" readonly></textarea>
                    </div>
                </details>
            </section>

            <!-- Action Bar -->
            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6 border-t border-outline-variant">
                <a class="h-10 px-6 rounded-full border border-outline-variant bg-surface-container-lowest text-on-surface-variant font-label-md text-xs font-semibold hover:bg-surface-container-low transition-colors flex items-center justify-center" href="{{ route('admin.events.index') }}">
                    Cancel
                </a>
                <button class="h-10 px-8 rounded-full bg-primary text-white font-label-md text-xs font-semibold hover:bg-primary/90 transition-colors shadow-sm" type="submit">
                    Create Event
                </button>
            </div>
        </form>
    </main>

    <!-- BottomNavBar (Mobile) -->
    <nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-3 bg-surface-container-lowest border-t border-outline-variant shadow-lg rounded-t-xl pb-safe">
        <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high active:scale-95 transition-transform rounded-lg p-1 w-16" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-label-md text-[10px] mt-1">Dashboard</span>
        </a>
        <a class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-full px-4 py-1 active:scale-95 transition-transform" href="{{ route('admin.events.index') }}">
            <span class="material-symbols-outlined" data-weight="fill">calendar_month</span>
            <span class="font-label-md text-[10px] mt-1">Events</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high active:scale-95 transition-transform rounded-lg p-1 w-16" href="{{ route('approvals.index') }}">
            <span class="material-symbols-outlined">fact_check</span>
            <span class="font-label-md text-[10px] mt-1">Approvals</span>
        </a>
    </nav>

    <script>
        // Total Capacity calculation
        const inputs = document.querySelectorAll('.quota-input');
        const totalDisplay = document.getElementById('totalCapacity');

        function calculateTotal() {
            let total = 0;
            inputs.forEach(input => {
                const val = parseInt(input.value) || 0;
                total += val;
            });
            if (totalDisplay) {
                totalDisplay.textContent = total;
            }
        }

        inputs.forEach(input => {
            input.addEventListener('input', calculateTotal);
        });
        calculateTotal();

        // Dynamic Approval Steps handling
        const approvalStepsContainer = document.getElementById('approvalStepsContainer');
        const addApprovalStepBtn = document.getElementById('addApprovalStepBtn');

        function updateStepNumbers() {
            const steps = approvalStepsContainer.querySelectorAll('.approval-step');
            steps.forEach((step, index) => {
                const numBadge = step.querySelector('.step-num');
                if (numBadge) {
                    numBadge.textContent = index + 1;
                    if (index === 0) {
                        numBadge.className = 'step-num w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs';
                    } else {
                        numBadge.className = 'step-num w-8 h-8 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-bold text-xs';
                    }
                }
            });
        }

        if (addApprovalStepBtn && approvalStepsContainer) {
            addApprovalStepBtn.addEventListener('click', () => {
                const currentCount = approvalStepsContainer.querySelectorAll('.approval-step').length;
                const newStep = document.createElement('div');
                newStep.className = 'approval-step flex items-center gap-3 bg-surface-container-low/50 border border-outline-variant rounded-xl p-3';
                newStep.innerHTML = `
                    <span class="material-symbols-outlined text-outline cursor-grab">drag_indicator</span>
                    <div class="step-num w-8 h-8 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-bold text-xs">${currentCount + 1}</div>
                    <div class="flex-1">
                        <select name="approval_bands[]" class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                            <option value="Direct Manager">Direct Manager</option>
                            <option value="Manager">Manager / Department Head</option>
                            <option value="Finance Director">Finance Director</option>
                            <option value="Security Officer">Security Officer</option>
                            <option value="Admin" selected>Admin</option>
                        </select>
                    </div>
                    <button class="remove-step-btn text-on-surface-variant hover:text-error transition-colors p-2 rounded-full hover:bg-error-container" type="button">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                `;
                approvalStepsContainer.appendChild(newStep);
                attachRemoveEvent(newStep.querySelector('.remove-step-btn'));
                updateStepNumbers();
            });
        }

        function attachRemoveEvent(btn) {
            if (!btn) return;
            btn.addEventListener('click', function() {
                const step = this.closest('.approval-step');
                if (step && approvalStepsContainer.querySelectorAll('.approval-step').length > 1) {
                    step.remove();
                    updateStepNumbers();
                }
            });
        }

        document.querySelectorAll('.remove-step-btn').forEach(btn => attachRemoveEvent(btn));

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
                card.className = 'form-field-card bg-surface-container-low/50 border border-outline-variant rounded-xl p-4 transition-all hover:border-primary/50 relative group shadow-sm';
                
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