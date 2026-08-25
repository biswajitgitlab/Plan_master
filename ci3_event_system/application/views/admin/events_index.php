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
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg pt-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Event Management</h1>
                <p class="font-body-md text-on-surface-variant">Create and monitor corporate events, participant quotas, and approval rules.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= site_url('admin/create_event'); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-full font-label-md hover:bg-primary/90 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Create New Event
                </a>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Filter & Search Controls Bar -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 mb-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <span class="text-xs font-bold text-on-surface">Filter Demand:</span>
                <a href="<?= site_url('admin/events?demand=all&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $demand_filter === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    All Events
                </a>
                <a href="<?= site_url('admin/events?demand=high_demand&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $demand_filter === 'high_demand' ? 'bg-error text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    High Demand (≥90%)
                </a>
                <a href="<?= site_url('admin/events?demand=normal&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $demand_filter === 'normal' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    Normal Demand (<90%)
                </a>
            </div>

            <form method="GET" action="<?= site_url('admin/events'); ?>" class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">
                <input type="hidden" name="demand" value="<?= htmlspecialchars($demand_filter); ?>"/>
                
                <select name="sort" onchange="this.form.submit()" class="h-9 px-3 text-xs rounded-full border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary">
                    <option value="start_date_asc" <?= $sort === 'start_date_asc' ? 'selected' : ''; ?>>Date: Earliest First</option>
                    <option value="start_date_desc" <?= $sort === 'start_date_desc' ? 'selected' : ''; ?>>Date: Latest First</option>
                    <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : ''; ?>>Title: A-Z</option>
                    <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : ''; ?>>Title: Z-A</option>
                </select>

                <div class="relative w-full sm:w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input type="text" name="search" value="<?= htmlspecialchars($search ? $search : ''); ?>" placeholder="Search title or location..." class="w-full h-9 pl-9 pr-3 rounded-full border border-outline-variant bg-surface-container-lowest text-xs focus:outline-none focus:border-primary"/>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <?php
                        $totalCapacity = $event->total_capacity;
                        $activeRegsCount = $event->active_regs;
                        $percent = $event->utilization_pct;

                        $waitlistCount = 0;
                        if (!empty($event->registrations)) {
                            foreach ($event->registrations as $r) {
                                if ($r->status === 'waitlisted') $waitlistCount++;
                            }
                        }

                        $startDateFormatted = date('M d, Y', strtotime($event->start_date));
                    ?>
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col relative group">
                        <div class="absolute top-0 left-0 w-full h-1 <?= $percent >= 90 ? 'bg-error' : ($percent >= 70 ? 'bg-tertiary' : 'bg-primary'); ?> z-10"></div>
                        
                        <?php if ($event->image_path): ?>
                            <div class="h-36 w-full relative bg-surface-variant overflow-hidden">
                                <img src="<?= base_url('uploads/' . $event->image_path); ?>" alt="<?= htmlspecialchars($event->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                            </div>
                        <?php else: ?>
                            <div class="h-28 w-full bg-gradient-to-r from-primary-container/20 to-primary/10 flex items-center justify-center p-4">
                                <span class="material-symbols-outlined text-4xl text-primary/40">event</span>
                            </div>
                        <?php endif; ?>

                        <div class="p-6 flex flex-col gap-4 flex-grow">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <h2 class="font-headline-md text-lg font-bold text-on-surface mb-1"><?= htmlspecialchars($event->name); ?></h2>
                                    <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                        <?= $startDateFormatted; ?>
                                    </p>
                                </div>
                                <span class="px-2.5 py-1 text-xs rounded-full font-semibold flex-shrink-0 <?= $percent >= 90 ? 'bg-error-container text-on-error-container' : 'bg-primary-fixed text-on-primary-fixed-variant'; ?>">
                                    <?= $percent >= 90 ? 'High Demand' : 'Active'; ?>
                                </span>
                            </div>

                            <p class="text-xs text-on-surface-variant line-clamp-2"><?= htmlspecialchars($event->description ? $event->description : 'No description provided.'); ?></p>

                            <div>
                                <div class="flex justify-between font-label-md text-xs mb-1.5">
                                    <span class="text-on-surface">Overall Quota Usage</span>
                                    <span class="font-bold text-primary"><?= $activeRegsCount; ?> / <?= $totalCapacity > 0 ? $totalCapacity : 'Unlimited'; ?> (<?= $percent; ?>%)</span>
                                </div>
                                <div class="w-full bg-surface-container-highest rounded-full h-2 overflow-hidden">
                                    <div class="h-2 rounded-full <?= $percent >= 90 ? 'bg-error' : 'bg-primary'; ?>" style="width: <?= $percent; ?>%"></div>
                                </div>
                            </div>

                            <?php if (!empty($event->quotas)): ?>
                                <div class="grid grid-cols-3 gap-2 py-2 border-y border-outline-variant/40">
                                    <?php foreach ($event->quotas as $quota): ?>
                                        <?php
                                            $roleRegs = 0;
                                            if (!empty($event->registrations)) {
                                                foreach ($event->registrations as $r) {
                                                    if ($r->status !== 'rejected' && strtolower($r->user_role) === strtolower($quota->role_name)) {
                                                        $roleRegs++;
                                                    }
                                                }
                                            }
                                        ?>
                                        <div class="flex flex-col gap-0.5 text-center">
                                            <span class="text-[11px] text-on-surface-variant font-medium truncate"><?= htmlspecialchars($quota->role_name); ?></span>
                                            <span class="text-xs font-bold text-on-surface"><?= $roleRegs; ?>/<?= $quota->quota_limit; ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex items-center gap-2 mt-auto text-on-surface-variant text-xs font-medium">
                                <span class="material-symbols-outlined text-[16px]">group</span>
                                <span><?= $waitlistCount; ?> registrant(s) on waitlist</span>
                            </div>
                        </div>

                        <div class="bg-surface-container-low px-6 py-3 border-t border-outline-variant flex justify-end gap-3">
                            <a href="<?= site_url('admin/delete_event/' . $event->id); ?>" onclick="return confirm('Are you sure you want to delete this event?');" class="font-label-md text-xs text-error hover:bg-error-container px-3 py-1.5 rounded transition-colors flex items-center">
                                Delete
                            </a>
                            <a href="<?= site_url('admin/edit_event/' . $event->id); ?>" class="font-label-md text-xs bg-white border border-outline-variant text-on-surface hover:bg-surface-container px-4 py-1.5 rounded-full transition-colors font-semibold">
                                Edit & Manage
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-12 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-xl">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">event_busy</span>
                    <p class="font-medium">No events found matching your filter and query.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination Controls -->
        <?php if ($total_pages > 1): ?>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 shadow-sm">
                <div class="text-xs font-semibold text-on-surface-variant">
                    Showing <span class="text-on-surface font-bold"><?= min($total_records, ($page - 1) * $limit + 1); ?></span> to <span class="text-on-surface font-bold"><?= min($total_records, $page * $limit); ?></span> of <span class="text-on-surface font-bold"><?= $total_records; ?></span> events
                </div>

                <div class="flex items-center gap-1.5">
                    <?php if ($page > 1): ?>
                        <a href="<?= site_url('admin/events?demand=' . urlencode($demand_filter) . '&sort=' . urlencode($sort) . '&search=' . urlencode($search) . '&page=' . ($page - 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">chevron_left</span> Previous
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="<?= site_url('admin/events?demand=' . urlencode($demand_filter) . '&sort=' . urlencode($sort) . '&search=' . urlencode($search) . '&page=' . $i); ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all <?= $i === $page ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high'; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="<?= site_url('admin/events?demand=' . urlencode($demand_filter) . '&sort=' . urlencode($sort) . '&search=' . urlencode($search) . '&page=' . ($page + 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            Next <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
