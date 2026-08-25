<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard - Quota Monitoring</title>
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
                    <?= strtoupper(substr($this->session->userdata('name') ? $this->session->userdata('name') : 'Admin', 0, 1)); ?>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-md text-on-surface truncate"><?= $this->session->userdata('name') ? $this->session->userdata('name') : 'System Admin'; ?></span>
                    <span class="text-xs text-on-surface-variant"><?= $this->session->userdata('role') ? $this->session->userdata('role') : 'Admin'; ?></span>
                </div>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" title="Logout" class="text-on-surface-variant hover:text-error transition-colors p-1">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
        <div class="flex flex-col gap-1">
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="<?= site_url('admin'); ?>">
                <span class="material-symbols-outlined" data-weight="fill">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('admin/events'); ?>">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="font-label-md">Events</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('approvals'); ?>">
                <span class="material-symbols-outlined">fact_check</span>
                <span class="font-label-md">Approvals</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg pt-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Admin: Quota & System Monitoring</h1>
                <p class="font-body-md text-on-surface-variant">Real-time statistics on capacity utilization, role distribution, and approval queues.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= site_url('admin/create_event'); ?>" class="px-5 py-2.5 bg-primary text-white rounded-full font-label-md hover:bg-primary/90 transition-colors shadow-sm inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Create Event
                </a>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Top Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-xl shadow-sm flex items-center gap-4">
                <div class="p-3 bg-primary-fixed text-primary rounded-xl">
                    <span class="material-symbols-outlined text-2xl">event</span>
                </div>
                <div>
                    <div class="text-2xl font-bold text-on-surface"><?= $total_records; ?></div>
                    <div class="text-xs text-on-surface-variant font-medium">Total Events</div>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-xl shadow-sm flex items-center gap-4">
                <div class="p-3 bg-emerald-100 text-emerald-700 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">how_to_reg</span>
                </div>
                <div>
                    <div class="text-2xl font-bold text-on-surface"><?= $total_active_regs; ?></div>
                    <div class="text-xs text-on-surface-variant font-medium">Active Registrations</div>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-xl shadow-sm flex items-center gap-4">
                <div class="p-3 bg-amber-100 text-amber-700 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">hourglass_top</span>
                </div>
                <div>
                    <div class="text-2xl font-bold text-on-surface"><?= $total_waitlisted; ?></div>
                    <div class="text-xs text-on-surface-variant font-medium">Waitlisted Registrants</div>
                </div>
            </div>
        </div>

        <!-- Filter & Search Controls -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 mb-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 w-full md:w-auto">
                <h2 class="text-base font-bold text-on-surface flex-shrink-0">Filter Quotas:</h2>
                <div class="flex gap-1.5 overflow-x-auto w-full md:w-auto">
                    <a href="<?= site_url('admin?health=all&search=' . urlencode($search)); ?>" class="px-3.5 py-1.5 text-xs font-bold rounded-full transition-all flex items-center gap-1 <?= $health_filter === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                        All Statuses
                    </a>
                    <a href="<?= site_url('admin?health=critical&search=' . urlencode($search)); ?>" class="px-3.5 py-1.5 text-xs font-bold rounded-full transition-all flex items-center gap-1 <?= $health_filter === 'critical' ? 'bg-error text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                        <span class="w-2 h-2 rounded-full bg-error"></span>
                        Critical (≥90%)
                    </a>
                    <a href="<?= site_url('admin?health=healthy&search=' . urlencode($search)); ?>" class="px-3.5 py-1.5 text-xs font-bold rounded-full transition-all flex items-center gap-1 <?= $health_filter === 'healthy' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Healthy (<90%)
                    </a>
                </div>
            </div>

            <form method="GET" action="<?= site_url('admin'); ?>" class="flex gap-2 w-full md:w-72">
                <input type="hidden" name="health" value="<?= htmlspecialchars($health_filter); ?>"/>
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input type="text" name="search" value="<?= htmlspecialchars($search ? $search : ''); ?>" placeholder="Search by title or location..." class="w-full h-9 pl-9 pr-3 rounded-full border border-outline-variant bg-surface-container-lowest text-xs focus:outline-none focus:border-primary"/>
                </div>
            </form>
        </div>

        <!-- Live Quota Status Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <?php
                        $totalCapacity = $event->total_capacity;
                        $activeRegs = $event->active_regs;
                        $percent = $event->utilization_pct;
                        
                        $waitlistedCount = 0;
                        if (!empty($event->registrations)) {
                            foreach ($event->registrations as $r) {
                                if ($r->status === 'waitlisted') $waitlistedCount++;
                            }
                        }

                        $startDateFormatted = date('M d, Y', strtotime($event->start_date));
                    ?>
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col relative">
                        <div class="absolute top-0 left-0 w-full h-1 <?= $percent >= 90 ? 'bg-error' : ($percent >= 75 ? 'bg-tertiary' : 'bg-primary'); ?>"></div>
                        <div class="p-6 flex flex-col gap-4 flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-on-surface text-base mb-1"><?= htmlspecialchars($event->name); ?></h3>
                                    <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                        <?= $startDateFormatted; ?>
                                    </p>
                                </div>
                                <span class="px-2.5 py-0.5 text-[11px] rounded-full font-semibold <?= $percent >= 90 ? 'bg-error-container text-on-error-container' : 'bg-primary-fixed text-on-primary-fixed-variant'; ?>">
                                    <?= $percent >= 90 ? 'Critical' : 'Healthy'; ?>
                                </span>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-semibold mb-1">
                                    <span>Overall Usage</span>
                                    <span><?= $activeRegs; ?> / <?= $totalCapacity > 0 ? $totalCapacity : 'Unlimited'; ?> (<?= $percent; ?>%)</span>
                                </div>
                                <div class="w-full bg-surface-container-highest rounded-full h-2 overflow-hidden">
                                    <div class="h-2 rounded-full <?= $percent >= 90 ? 'bg-error' : 'bg-primary'; ?>" style="width: <?= $percent; ?>%"></div>
                                </div>
                            </div>

                            <?php if (!empty($event->quotas)): ?>
                                <div class="grid grid-cols-3 gap-2 py-3 border-y border-outline-variant/40">
                                    <?php foreach ($event->quotas as $quota): ?>
                                        <?php
                                            $roleCount = 0;
                                            if (!empty($event->registrations)) {
                                                foreach ($event->registrations as $r) {
                                                    if ($r->status !== 'rejected' && strtolower($r->user_role) === strtolower($quota->role_name)) {
                                                        $roleCount++;
                                                    }
                                                }
                                            }
                                            $qLimit = max(1, (int)$quota->quota_limit);
                                            $qPercent = min(100, round(($roleCount / $qLimit) * 100));
                                        ?>
                                        <div class="flex flex-col gap-1">
                                            <span class="text-[10px] uppercase font-bold text-on-surface-variant truncate"><?= htmlspecialchars($quota->role_name); ?></span>
                                            <span class="text-xs font-semibold text-on-surface"><?= $roleCount; ?>/<?= $quota->quota_limit; ?></span>
                                            <div class="w-full bg-surface-container-highest rounded-full h-1">
                                                <div class="bg-primary h-1 rounded-full" style="width: <?= $qPercent; ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex items-center justify-between text-xs text-on-surface-variant mt-auto pt-2">
                                <span class="flex items-center gap-1 font-medium">
                                    <span class="material-symbols-outlined text-[16px]">group</span>
                                    <?= $waitlistedCount; ?> waitlisted
                                </span>
                            </div>
                        </div>

                        <div class="bg-surface-container-low px-6 py-3 border-t border-outline-variant flex justify-end gap-3">
                            <a href="<?= site_url('admin/edit_event/' . $event->id); ?>" class="text-xs font-semibold text-primary hover:underline">
                                Edit Event Quotas & Rules →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-12 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                    No events found matching current filter and query.
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination Footer Controls -->
        <?php if ($total_pages > 1): ?>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 shadow-sm">
                <div class="text-xs font-semibold text-on-surface-variant">
                    Showing <span class="text-on-surface font-bold"><?= min($total_records, ($page - 1) * $limit + 1); ?></span> to <span class="text-on-surface font-bold"><?= min($total_records, $page * $limit); ?></span> of <span class="text-on-surface font-bold"><?= $total_records; ?></span> events
                </div>

                <div class="flex items-center gap-1.5">
                    <?php if ($page > 1): ?>
                        <a href="<?= site_url('admin?health=' . urlencode($health_filter) . '&search=' . urlencode($search) . '&page=' . ($page - 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">chevron_left</span> Previous
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="<?= site_url('admin?health=' . urlencode($health_filter) . '&search=' . urlencode($search) . '&page=' . $i); ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all <?= $i === $page ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high'; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="<?= site_url('admin?health=' . urlencode($health_filter) . '&search=' . urlencode($search) . '&page=' . ($page + 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            Next <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
