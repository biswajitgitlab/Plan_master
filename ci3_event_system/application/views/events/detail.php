<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= htmlspecialchars($event->name); ?> - Event Details</title>
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
                    <?= strtoupper(substr($this->session->userdata('name') ? $this->session->userdata('name') : 'U', 0, 1)); ?>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-md text-on-surface truncate"><?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Participant'; ?></span>
                    <span class="text-xs font-bold text-primary"><?= $this->session->userdata('role') ? $this->session->userdata('role') : 'Employee'; ?></span>
                </div>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" title="Logout" class="text-on-surface-variant hover:text-error transition-colors p-1">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
        <div class="flex flex-col gap-1">
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="<?= site_url('events'); ?>">
                <span class="material-symbols-outlined" data-weight="fill">calendar_month</span>
                <span>All Events</span>
            </a>
            <?php if ($this->session->userdata('role') === 'Admin'): ?>
                <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('admin'); ?>">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md">Admin Dashboard</span>
                </a>
            <?php endif; ?>
            <?php if (in_array($this->session->userdata('role'), ['Admin', 'Sub-Admin', 'Manager'])): ?>
                <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('approvals'); ?>">
                    <span class="material-symbols-outlined">fact_check</span>
                    <span class="font-label-md">Approvals Portal</span>
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1000px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex items-center gap-4 mb-stack-lg pt-4">
            <a href="<?= site_url('events'); ?>" class="w-9 h-9 rounded-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center text-on-surface-variant hover:text-primary hover:border-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1"><?= htmlspecialchars($event->name); ?></h1>
                <p class="font-body-md text-on-surface-variant">Registration & Event Overview</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 p-4 bg-error-container text-on-error-container border border-error/20 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-error">error</span>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('warning')): ?>
            <div class="mb-6 p-4 bg-amber-50 text-amber-900 border border-amber-200 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-amber-600">hourglass_top</span>
                <?= $this->session->flashdata('warning'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Event Banner / Image -->
        <?php if ($event->image_path): ?>
            <div class="w-full h-64 md:h-80 rounded-2xl overflow-hidden mb-8 border border-outline-variant shadow-sm relative">
                <img src="<?= base_url('uploads/' . $event->image_path); ?>" alt="<?= htmlspecialchars($event->name); ?>" class="w-full h-full object-cover"/>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 sm:p-8 shadow-sm">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span>
                        About Event
                    </h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed whitespace-pre-line"><?= htmlspecialchars($event->description ? $event->description : 'No description provided.'); ?></p>
                </div>

                <!-- Registration Form / Existing Registration Status -->
                <?php if ($registration): ?>
                    <!-- Already Registered Status Card -->
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 sm:p-8 shadow-sm">
                        <div class="flex items-center justify-between border-b border-outline-variant pb-4 mb-6">
                            <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">assignment_turned_in</span>
                                Your Registration Status
                            </h2>
                            <?php
                                $statusClass = 'bg-blue-100 text-blue-800';
                                $statusLabel = 'Pending Approval';
                                if ($registration->status === 'approved') {
                                    $statusClass = 'bg-emerald-100 text-emerald-800';
                                    $statusLabel = 'Registration Approved';
                                } elseif ($registration->status === 'waitlisted') {
                                    $statusClass = 'bg-amber-100 text-amber-800';
                                    $statusLabel = 'Waitlisted';
                                } elseif ($registration->status === 'rejected') {
                                    $statusClass = 'bg-red-100 text-red-800';
                                    $statusLabel = 'Registration Rejected';
                                }
                            ?>
                            <span class="px-3.5 py-1 rounded-full text-xs font-bold <?= $statusClass; ?>">
                                <?= $statusLabel; ?>
                            </span>
                        </div>

                        <?php if ($registration->status === 'waitlisted'): ?>
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-900 text-xs mb-6 flex items-start gap-3">
                                <span class="material-symbols-outlined text-amber-600 text-[20px] mt-0.5">info</span>
                                <div>
                                    <strong class="font-bold block mb-0.5">Waitlist Active</strong>
                                    You are currently on the waitlist for your role quota. If another participant cancels or gets rejected, you will be automatically promoted!
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Approval Band Sequence Timeline Tracker -->
                        <?php if (!empty($approval_bands)): ?>
                            <div class="mb-6">
                                <h3 class="text-xs font-bold text-on-surface uppercase tracking-wider mb-4">Approval Pipeline Progress</h3>
                                <div class="space-y-3">
                                    <?php foreach ($approval_bands as $band): ?>
                                        <?php
                                            $isCurrent = ($registration->status === 'pending' && $registration->current_approval_level == $band->level_sequence);
                                            $isPassed = ($registration->status === 'approved' || $registration->current_approval_level > $band->level_sequence);
                                        ?>
                                        <div class="flex items-center gap-3 p-3 rounded-xl border <?= $isCurrent ? 'bg-primary-fixed/40 border-primary' : ($isPassed ? 'bg-emerald-50 border-emerald-200' : 'bg-surface-container-low border-outline-variant'); ?>">
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center font-bold text-xs <?= $isCurrent ? 'bg-primary text-white' : ($isPassed ? 'bg-emerald-600 text-white' : 'bg-surface-container-high text-on-surface-variant'); ?>">
                                                <?= $isPassed ? '✓' : $band->level_sequence; ?>
                                            </div>
                                            <div class="flex-1">
                                                <span class="font-bold text-xs text-on-surface">Level <?= $band->level_sequence; ?>: <?= htmlspecialchars($band->role_name); ?> Review</span>
                                            </div>
                                            <span class="text-[11px] font-semibold <?= $isCurrent ? 'text-primary' : ($isPassed ? 'text-emerald-700' : 'text-on-surface-variant'); ?>">
                                                <?= $isPassed ? 'Passed' : ($isCurrent ? 'In Review' : 'Pending'); ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Submitted Data Breakdown -->
                        <?php if (!empty($registration->form_data)): ?>
                            <?php $formDataObj = json_decode($registration->form_data, true); ?>
                            <?php if (!empty($formDataObj) && is_array($formDataObj)): ?>
                                <div>
                                    <h3 class="text-xs font-bold text-on-surface uppercase tracking-wider mb-3">Submitted Details</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 bg-surface-container-low rounded-xl border border-outline-variant/60">
                                        <?php foreach ($formDataObj as $k => $v): ?>
                                            <div>
                                                <span class="text-[11px] text-on-surface-variant font-medium uppercase block"><?= htmlspecialchars(str_replace('_', ' ', $k)); ?></span>
                                                <span class="text-xs font-semibold text-on-surface"><?= htmlspecialchars(is_array($v) ? implode(', ', $v) : $v); ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- Registration Form -->
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 sm:p-8 shadow-sm">
                        <h2 class="font-headline-md text-lg font-bold text-on-surface mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">app_registration</span>
                            Register For Event
                        </h2>

                        <form method="POST" action="<?= site_url('events/register/' . $event->id); ?>" class="space-y-5">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"/>

                            <?php
                                $formSchemaArray = [];
                                if (!empty($event->form_schema)) {
                                    $formSchemaArray = json_decode($event->form_schema, true);
                                }
                            ?>

                            <?php if (!empty($formSchemaArray) && is_array($formSchemaArray)): ?>
                                <?php foreach ($formSchemaArray as $field): ?>
                                    <?php
                                        $fName = isset($field['name']) ? $field['name'] : 'field';
                                        $fLabel = isset($field['label']) ? $field['label'] : ucfirst($fName);
                                        $fType = isset($field['type']) ? $field['type'] : 'text';
                                        $fReq = !empty($field['required']);
                                        $fOpts = isset($field['options']) && is_array($field['options']) ? $field['options'] : [];
                                    ?>
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1.5 font-label-md">
                                            <?= htmlspecialchars($fLabel); ?> <?= $fReq ? '<span class="text-error">*</span>' : ''; ?>
                                        </label>

                                        <?php if ($fType === 'select'): ?>
                                            <select name="dynamic_field[<?= htmlspecialchars($fName); ?>]" <?= $fReq ? 'required' : ''; ?> class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary">
                                                <option value="">-- Select Option --</option>
                                                <?php foreach ($fOpts as $opt): ?>
                                                    <option value="<?= htmlspecialchars($opt); ?>"><?= htmlspecialchars($opt); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php elseif ($fType === 'textarea'): ?>
                                            <textarea name="dynamic_field[<?= htmlspecialchars($fName); ?>]" <?= $fReq ? 'required' : ''; ?> rows="3" class="w-full p-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"></textarea>
                                        <?php elseif ($fType === 'number'): ?>
                                            <input type="number" name="dynamic_field[<?= htmlspecialchars($fName); ?>]" <?= $fReq ? 'required' : ''; ?> class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                                        <?php else: ?>
                                            <input type="text" name="dynamic_field[<?= htmlspecialchars($fName); ?>]" <?= $fReq ? 'required' : ''; ?> class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary"/>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-xs text-on-surface-variant">No custom questions required for this event.</p>
                            <?php endif; ?>

                            <button type="submit" class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold text-sm rounded-full shadow-md transition-all flex items-center justify-center gap-2">
                                <span>Submit Registration</span>
                                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Side column: Event metadata & Quota Status -->
            <div class="space-y-6">
                <!-- Metadata card -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-headline-md text-base font-bold text-on-surface border-b border-outline-variant pb-3">Event Schedule</h3>
                    
                    <div class="space-y-3 text-xs">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">calendar_month</span>
                            <div>
                                <span class="font-bold text-on-surface block">Start Date</span>
                                <span class="text-on-surface-variant"><?= date('F d, Y - h:i A', strtotime($event->start_date)); ?></span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">event</span>
                            <div>
                                <span class="font-bold text-on-surface block">End Date</span>
                                <span class="text-on-surface-variant"><?= date('F d, Y - h:i A', strtotime($event->end_date)); ?></span>
                            </div>
                        </div>

                        <?php if ($event->location): ?>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">location_on</span>
                                <div>
                                    <span class="font-bold text-on-surface block">Location</span>
                                    <span class="text-on-surface-variant"><?= htmlspecialchars($event->location); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Role Quota Status Card -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 shadow-sm">
                    <h3 class="font-headline-md text-base font-bold text-on-surface border-b border-outline-variant pb-3 mb-4">Role Quota Breakdown</h3>
                    
                    <?php if (!empty($quotas)): ?>
                        <div class="space-y-4">
                            <?php foreach ($quotas as $q): ?>
                                <?php
                                    $userRole = $this->session->userdata('role') ? $this->session->userdata('role') : 'Employee';
                                    $isUserRole = (strtolower($userRole) === strtolower($q->role_name));
                                    
                                    $regCount = 0;
                                    if (!empty($event->registrations)) {
                                        foreach ($event->registrations as $r) {
                                            if ($r->status !== 'rejected' && strtolower($r->user_role) === strtolower($q->role_name)) {
                                                $regCount++;
                                            }
                                        }
                                    }
                                    $limit = max(1, (int)$q->quota_limit);
                                    $pct = min(100, round(($regCount / $limit) * 100));
                                ?>
                                <div class="p-3 rounded-xl border <?= $isUserRole ? 'bg-primary-fixed/30 border-primary' : 'bg-surface-container-low border-outline-variant/60'; ?>">
                                    <div class="flex justify-between items-center text-xs font-bold mb-1">
                                        <span class="text-on-surface flex items-center gap-1">
                                            <?= htmlspecialchars($q->role_name); ?>
                                            <?= $isUserRole ? '<span class="text-[10px] bg-primary text-white px-1.5 py-0.5 rounded font-normal">Your Role</span>' : ''; ?>
                                        </span>
                                        <span><?= $regCount; ?> / <?= $q->quota_limit; ?></span>
                                    </div>
                                    <div class="w-full bg-surface-container-highest rounded-full h-1.5 overflow-hidden">
                                        <div class="h-1.5 rounded-full <?= $pct >= 100 ? 'bg-amber-500' : 'bg-primary'; ?>" style="width: <?= $pct; ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-xs text-on-surface-variant italic">No role quota limits configured.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
