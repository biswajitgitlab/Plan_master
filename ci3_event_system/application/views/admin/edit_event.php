<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Event - <?= htmlspecialchars($event->name); ?></title>
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
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold flex-shrink-0">
                    <?= strtoupper(substr($this->session->userdata('name') ? $this->session->userdata('name') : 'A', 0, 1)); ?>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-md text-on-surface truncate"><?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Admin User'; ?></span>
                    <span class="text-xs text-on-surface-variant"><?= $this->session->userdata('role') ? $this->session->userdata('role') : 'Admin'; ?></span>
                </div>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" title="Logout" class="text-on-surface-variant hover:text-error transition-colors p-1">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
        <div class="flex flex-col gap-1">
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('admin'); ?>">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label-md">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="<?= site_url('admin/events'); ?>">
                <span class="material-symbols-outlined" data-weight="fill">calendar_month</span>
                <span>Events</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('approvals'); ?>">
                <span class="material-symbols-outlined">fact_check</span>
                <span class="font-label-md">Approvals</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1000px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex items-center justify-between gap-4 mb-stack-lg pt-4">
            <div class="flex items-center gap-4">
                <a href="<?= site_url('admin/events'); ?>" class="w-9 h-9 rounded-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center text-on-surface-variant hover:text-primary hover:border-primary transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div>
                    <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Edit Event Details</h1>
                    <p class="font-body-md text-on-surface-variant">Update rules, quotas, and form schema for "<?= htmlspecialchars($event->name); ?>"</p>
                </div>
            </div>
            <a href="<?= site_url('events/detail/' . $event->id); ?>" target="_blank" class="px-4 py-2 border border-outline-variant bg-white text-on-surface rounded-full text-xs font-semibold hover:bg-surface-container transition-colors inline-flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined text-[16px]">visibility</span>
                Preview Public Page
            </a>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="<?= site_url('admin/update_event/' . $event->id); ?>" enctype="multipart/form-data">
            <!-- Section 1: Basic Event Details -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        General Event Information
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5">Banner Image</label>
                        <div class="flex items-center gap-4">
                            <?php if ($event->image_path): ?>
                                <div class="w-32 h-20 rounded-lg overflow-hidden border border-outline-variant flex-shrink-0 bg-surface-container-low">
                                    <img src="<?= base_url('uploads/' . $event->image_path); ?>" class="w-full h-full object-cover"/>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <input type="file" name="image" accept="image/*" class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"/>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="eventTitle">Event Title *</label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary transition-all" id="eventTitle" name="name" required value="<?= htmlspecialchars($event->name); ?>" type="text"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="eventDesc">Description</label>
                        <textarea class="w-full p-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary transition-all resize-y" id="eventDesc" name="description" rows="4"><?= htmlspecialchars($event->description); ?></textarea>
                    </div>
                    <div>
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="startDate">Start Date & Time *</label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary transition-all" id="startDate" name="start_date" required value="<?= date('Y-m-d\TH:i', strtotime($event->start_date)); ?>" type="datetime-local"/>
                    </div>
                    <div>
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="endDate">End Date & Time *</label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary transition-all" id="endDate" name="end_date" required value="<?= date('Y-m-d\TH:i', strtotime($event->end_date)); ?>" type="datetime-local"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-label-md text-xs font-semibold text-on-surface mb-1.5" for="location">Location</label>
                        <input class="w-full h-10 px-3 rounded-md border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary transition-all" id="location" name="location" value="<?= htmlspecialchars($event->location ? $event->location : ''); ?>" type="text"/>
                    </div>
                </div>
            </section>

            <!-- Section 2: Quota Limits Management -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">groups</span>
                        Role Quota Allocations
                    </h2>
                </div>
                
                <div class="space-y-3 mb-6">
                    <?php if (!empty($event->quotas)): ?>
                        <?php foreach ($event->quotas as $quota): ?>
                            <div class="flex items-center justify-between p-3.5 bg-surface-container-low border border-outline-variant rounded-xl">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary">badge</span>
                                    <div>
                                        <span class="font-bold text-sm text-on-surface"><?= htmlspecialchars($quota->role_name); ?></span>
                                        <span class="text-xs text-on-surface-variant block">Quota Limit: <strong><?= $quota->quota_limit; ?></strong> registrants</span>
                                    </div>
                                </div>
                                <a href="<?= site_url('admin/delete_quota/' . $quota->id . '/' . $event->id); ?>" onclick="return confirm('Remove quota limit for <?= htmlspecialchars($quota->role_name); ?>?');" class="text-xs text-error hover:underline flex items-center gap-1 font-semibold">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                    Remove
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-xs text-on-surface-variant italic">No role quota allocations configured. Registrations are currently open with unlimited seats.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Section 3: Visual Dynamic Form Builder -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="border-b border-outline-variant pb-4 mb-6 flex justify-between items-center flex-wrap gap-3">
                    <div>
                        <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">tune</span>
                            Dynamic Registration Form Builder
                        </h2>
                        <p class="text-xs text-on-surface-variant mt-1">Configure questions and fields for registration.</p>
                    </div>
                    <button id="addFieldBtn" type="button" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-primary/10 text-primary border border-primary/20 hover:bg-primary hover:text-white rounded-full text-xs transition-all font-semibold">
                        <span class="material-symbols-outlined text-[16px]">add_circle</span>
                        + Add Question Field
                    </button>
                </div>

                <div id="visualFieldsContainer" class="space-y-4 mb-4"></div>

                <input type="hidden" name="form_schema" id="form_schema_hidden" value='<?= htmlspecialchars($event->form_schema ? $event->form_schema : '[]'); ?>'>

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

            <div class="flex justify-end gap-3 pt-6 border-t border-outline-variant">
                <a class="h-10 px-6 rounded-full border border-outline-variant bg-surface-container-lowest text-on-surface-variant font-label-md text-xs font-semibold hover:bg-surface-container-low transition-colors flex items-center justify-center" href="<?= site_url('admin/events'); ?>">
                    Cancel
                </a>
                <button class="h-10 px-8 rounded-full bg-primary text-white font-label-md text-xs font-semibold hover:bg-primary/90 transition-colors shadow-sm" type="submit">
                    Save Changes
                </button>
            </div>
        </form>
    </main>

    <script>
        // Visual Form Builder Logic for Edit Event
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
                initialData = [];
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

                        <div class="options-wrapper md:col-span-12 ${type === 'select' ? '' : 'hidden'}">
                            <label class="block font-label-md text-xs font-semibold text-primary mb-1">
                                Dropdown Choices (separate choices with commas) *
                            </label>
                            <input type="text" class="field-options w-full h-10 px-3 rounded-md border border-primary/40 bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary" placeholder="e.g. Option 1, Option 2, Option 3" value="${escapeHtml(optionsStr)}"/>
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
                    card.remove();
                    syncSchema();
                });

                syncSchema();
            }

            function escapeHtml(str) {
                return (str || '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }

            container.innerHTML = '';
            if (initialData.length > 0) {
                initialData.forEach(f => renderFieldCard(f));
            } else {
                renderFieldCard({ label: 'Question 1', type: 'text', required: false });
            }

            addBtn.addEventListener('click', () => {
                renderFieldCard({ label: 'New Question', type: 'text', required: false, options: [] });
            });
        })();
    </script>
</body>
</html>
