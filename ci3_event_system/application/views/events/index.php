<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Corporate Events - EventCentral</title>
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
        <?php if ($this->session->userdata('user_id')): ?>
        <div class="flex items-center justify-between px-4 py-3 mb-stack-md bg-surface-container-high rounded-lg">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold flex-shrink-0">
                    <?= strtoupper(substr($this->session->userdata('name'), 0, 1)); ?>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-label-md text-on-surface truncate"><?= $this->session->userdata('name'); ?></span>
                    <span class="text-xs font-bold text-primary"><?= $this->session->userdata('role'); ?></span>
                </div>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" title="Logout" class="text-on-surface-variant hover:text-error transition-colors p-1">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
        <?php else: ?>
        <div class="flex items-center justify-center mb-stack-md">
            <a href="<?= site_url('auth'); ?>" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white rounded-full font-bold text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">login</span>
                Sign In
            </a>
        </div>
        <?php endif; ?>
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
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg pt-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Corporate Events Catalog</h1>
                <p class="font-body-md text-on-surface-variant">Browse available workshops, summits, and strategic retreats.</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 p-4 bg-error-container text-on-error-container border border-error/20 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-error">error</span>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Filter & Search Controls Bar -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 mb-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <span class="text-xs font-bold text-on-surface">Filter Seats:</span>
                <a href="<?= site_url('events?availability=all&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $availability_filter === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    All Events
                </a>
                <?php if ($this->session->userdata('user_id')): ?>
                <a href="<?= site_url('events?availability=registered&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $availability_filter === 'registered' ? 'bg-blue-600 text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    My Registrations
                </a>
                <?php endif; ?>
                <a href="<?= site_url('events?availability=seats_available&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $availability_filter === 'seats_available' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    Seats Available
                </a>
                <a href="<?= site_url('events?availability=waitlist_open&sort=' . urlencode($sort) . '&search=' . urlencode($search)); ?>" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all <?= $availability_filter === 'waitlist_open' ? 'bg-amber-500 text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container'; ?>">
                    Waitlist Open
                </a>
            </div>

            <form method="GET" action="<?= site_url('events'); ?>" class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">
                <input type="hidden" name="availability" value="<?= htmlspecialchars($availability_filter); ?>"/>

                <select name="sort" onchange="this.form.submit()" class="h-9 px-3 text-xs rounded-full border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary">
                    <option value="start_date_asc" <?= $sort === 'start_date_asc' ? 'selected' : ''; ?>>Date: Earliest First</option>
                    <option value="start_date_desc" <?= $sort === 'start_date_desc' ? 'selected' : ''; ?>>Date: Latest First</option>
                    <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : ''; ?>>Title: A-Z</option>
                    <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : ''; ?>>Title: Z-A</option>
                </select>

                <div class="relative w-full sm:w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input type="text" name="search" value="<?= htmlspecialchars($search ? $search : ''); ?>" placeholder="Search corporate events..." class="w-full h-9 pl-9 pr-3 rounded-full border border-outline-variant bg-surface-container-lowest text-xs focus:outline-none focus:border-primary"/>
                </div>
            </form>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <?php
                        $userRole = $this->session->userdata('role') ? $this->session->userdata('role') : 'Employee';
                        $roleQuotaObj = NULL;
                        if (!empty($event->quotas)) {
                            foreach ($event->quotas as $q) {
                                if (strtolower($q->role_name) === strtolower($userRole)) {
                                    $roleQuotaObj = $q;
                                    break;
                                }
                            }
                        }

                        $roleRegCount = 0;
                        if (!empty($event->registrations)) {
                            foreach ($event->registrations as $r) {
                                if ($r->status !== 'rejected' && strtolower($r->user_role) === strtolower($userRole)) {
                                    $roleRegCount++;
                                }
                            }
                        }

                        $qLimit = $roleQuotaObj ? (int)$roleQuotaObj->quota_limit : 0;
                        $qPercent = $qLimit > 0 ? min(100, round(($roleRegCount / $qLimit) * 100)) : 0;
                        $isFull = $qLimit > 0 && $roleRegCount >= $qLimit;
                        $startDateFormatted = date('M d, Y', strtotime($event->start_date));

                        $userRegStatus = null;
                        if ($this->session->userdata('user_id') && !empty($event->registrations)) {
                            foreach ($event->registrations as $r) {
                                if ($r->user_id == $this->session->userdata('user_id')) {
                                    $userRegStatus = $r->status;
                                    break;
                                }
                            }
                        }
                    ?>
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
                        <?php if ($event->image_path): ?>
                            <div class="h-44 w-full relative bg-surface-variant overflow-hidden">
                                <img src="<?= base_url('uploads/' . $event->image_path); ?>" alt="<?= htmlspecialchars($event->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                                <div class="absolute top-3 right-3 flex flex-col gap-2 items-end">
                                    <span class="px-3 py-1 text-xs rounded-full font-bold shadow-md <?= $isFull ? 'bg-amber-500 text-white' : 'bg-emerald-500 text-white'; ?>">
                                        <?= $isFull ? 'Waitlist Open' : 'Registration Open'; ?>
                                    </span>
                                    <?php if ($userRegStatus): ?>
                                        <?php
                                            $badgeClass = 'bg-blue-500';
                                            if ($userRegStatus === 'approved') $badgeClass = 'bg-emerald-600';
                                            if ($userRegStatus === 'waitlisted') $badgeClass = 'bg-amber-500';
                                            if ($userRegStatus === 'rejected') $badgeClass = 'bg-red-500';
                                        ?>
                                        <span class="px-3 py-1 text-xs rounded-full font-bold shadow-md text-white <?= $badgeClass; ?>">
                                            Status: <?= ucfirst($userRegStatus); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="h-36 w-full bg-gradient-to-r from-primary-container/20 via-primary/10 to-surface-container-high flex items-center justify-between p-6 relative">
                                <span class="material-symbols-outlined text-5xl text-primary/30">event</span>
                                <div class="absolute top-3 right-3 flex flex-col gap-2 items-end">
                                    <span class="px-3 py-1 text-xs rounded-full font-bold shadow-sm <?= $isFull ? 'bg-amber-500 text-white' : 'bg-primary text-white'; ?>">
                                        <?= $isFull ? 'Waitlist Open' : 'Seats Available'; ?>
                                    </span>
                                    <?php if ($userRegStatus): ?>
                                        <?php
                                            $badgeClass = 'bg-blue-500';
                                            if ($userRegStatus === 'approved') $badgeClass = 'bg-emerald-600';
                                            if ($userRegStatus === 'waitlisted') $badgeClass = 'bg-amber-500';
                                            if ($userRegStatus === 'rejected') $badgeClass = 'bg-red-500';
                                        ?>
                                        <span class="px-3 py-1 text-xs rounded-full font-bold shadow-sm text-white <?= $badgeClass; ?>">
                                            Status: <?= ucfirst($userRegStatus); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="p-6 flex flex-col gap-4 flex-grow">
                            <div>
                                <div class="flex items-center gap-2 text-xs font-semibold text-primary mb-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                                    <span><?= $startDateFormatted; ?></span>
                                    <?php if ($event->location): ?>
                                        <span class="text-outline">•</span>
                                        <span class="truncate text-on-surface-variant"><?= htmlspecialchars($event->location); ?></span>
                                    <?php endif; ?>
                                </div>
                                <h3 class="font-headline-md text-lg font-bold text-on-surface group-hover:text-primary transition-colors mb-2"><?= htmlspecialchars($event->name); ?></h3>
                                <p class="text-xs text-on-surface-variant line-clamp-2"><?= htmlspecialchars($event->description ? $event->description : 'Join this strategic corporate session.'); ?></p>
                            </div>

                            <?php if ($this->session->userdata('user_id')): ?>
                            <div class="mt-auto pt-4 border-t border-outline-variant/50">
                                <div class="flex justify-between text-xs font-semibold mb-1">
                                    <span class="text-on-surface-variant">Your Role Quota (<?= htmlspecialchars($userRole); ?>)</span>
                                    <span class="text-on-surface font-bold"><?= $roleRegCount; ?> / <?= $qLimit > 0 ? $qLimit : 'Unlimited'; ?></span>
                                </div>
                                <?php if ($qLimit > 0): ?>
                                    <div class="w-full bg-surface-container-highest rounded-full h-1.5 overflow-hidden">
                                        <div class="h-1.5 rounded-full <?= $isFull ? 'bg-amber-500' : 'bg-primary'; ?>" style="width: <?= $qPercent; ?>%"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="bg-surface-container-low px-6 py-4 border-t border-outline-variant flex items-center justify-between">
                            <span class="text-xs font-medium text-on-surface-variant">
                                <?= !empty($event->approval_bands) ? count($event->approval_bands) . '-Tier Approval' : 'Direct Sign-Up'; ?>
                            </span>
                            <a href="<?= site_url('events/detail/' . $event->id); ?>" class="inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                                <?= $userRegStatus ? 'View Event →' : 'View Event & Register →'; ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-16 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-2xl">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">event_busy</span>
                    <p class="font-bold text-base text-on-surface">No corporate events found matching your filter.</p>
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
                        <a href="<?= site_url('events?availability=' . urlencode($availability_filter) . '&sort=' . urlencode($sort) . '&search=' . urlencode($search) . '&page=' . ($page - 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">chevron_left</span> Previous
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="<?= site_url('events?availability=' . urlencode($availability_filter) . '&sort=' . urlencode($sort) . '&search=' . urlencode($search) . '&page=' . $i); ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all <?= $i === $page ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high'; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="<?= site_url('events?availability=' . urlencode($availability_filter) . '&sort=' . urlencode($sort) . '&search=' . urlencode($search) . '&page=' . ($page + 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            Next <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
