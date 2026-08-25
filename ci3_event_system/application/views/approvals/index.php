<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Approvals Portal - EventCentral</title>
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
                    <span class="font-label-md text-on-surface truncate"><?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Approver'; ?></span>
                    <span class="text-xs font-bold text-primary"><?= $this->session->userdata('role') ? $this->session->userdata('role') : 'Sub-Admin'; ?></span>
                </div>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" title="Logout" class="text-on-surface-variant hover:text-error transition-colors p-1">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
        <div class="flex flex-col gap-1">
            <?php if ($this->session->userdata('role') === 'Admin'): ?>
                <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('admin'); ?>">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md">Admin Dashboard</span>
                </a>
            <?php endif; ?>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all" href="<?= site_url('events'); ?>">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="font-label-md">All Events</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md" href="<?= site_url('approvals'); ?>">
                <span class="material-symbols-outlined" data-weight="fill">fact_check</span>
                <span>Approvals Portal</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-72 p-container-padding max-w-[1200px] w-full mx-auto pb-24 md:pb-container-padding">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg pt-4">
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-on-surface mb-1">Registration Approvals Portal</h1>
                <p class="font-body-md text-on-surface-variant">Review pending event registration requests, approve, or reject applications.</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 p-4 bg-error-container text-on-error-container border border-error/20 rounded-xl flex items-center gap-2 font-medium text-sm">
                <span class="material-symbols-outlined text-error">error</span>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Filter Controls Bar -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 mb-6 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-4">
            <div class="flex gap-1.5 border-b lg:border-b-0 border-outline-variant/60 w-full lg:w-auto overflow-x-auto pb-2 lg:pb-0">
                <a href="<?= site_url('approvals?status=pending&role=' . urlencode($role_filter) . '&search=' . urlencode($search)); ?>" class="px-4 py-2 text-xs font-bold rounded-full transition-all flex items-center gap-1.5 <?= $status_filter === 'pending' ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container'; ?>">
                    <span>Pending</span>
                </a>
                <a href="<?= site_url('approvals?status=approved&role=' . urlencode($role_filter) . '&search=' . urlencode($search)); ?>" class="px-4 py-2 text-xs font-bold rounded-full transition-all flex items-center gap-1.5 <?= $status_filter === 'approved' ? 'bg-emerald-600 text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container'; ?>">
                    <span>Approved</span>
                </a>
                <a href="<?= site_url('approvals?status=waitlisted&role=' . urlencode($role_filter) . '&search=' . urlencode($search)); ?>" class="px-4 py-2 text-xs font-bold rounded-full transition-all flex items-center gap-1.5 <?= $status_filter === 'waitlisted' ? 'bg-amber-500 text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container'; ?>">
                    <span>Waitlisted</span>
                </a>
                <a href="<?= site_url('approvals?status=rejected&role=' . urlencode($role_filter) . '&search=' . urlencode($search)); ?>" class="px-4 py-2 text-xs font-bold rounded-full transition-all flex items-center gap-1.5 <?= $status_filter === 'rejected' ? 'bg-red-600 text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container'; ?>">
                    <span>Rejected</span>
                </a>
                <a href="<?= site_url('approvals?status=all&role=' . urlencode($role_filter) . '&search=' . urlencode($search)); ?>" class="px-4 py-2 text-xs font-bold rounded-full transition-all flex items-center gap-1.5 <?= $status_filter === 'all' ? 'bg-surface-container-highest text-on-surface shadow-sm' : 'text-on-surface-variant hover:bg-surface-container'; ?>">
                    <span>All Applications</span>
                </a>
            </div>

            <form method="GET" action="<?= site_url('approvals'); ?>" class="flex flex-col sm:flex-row items-center gap-2 w-full lg:w-auto">
                <input type="hidden" name="status" value="<?= htmlspecialchars($status_filter); ?>"/>

                <select name="role" onchange="this.form.submit()" class="h-9 px-3 text-xs rounded-full border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary">
                    <option value="all" <?= $role_filter === 'all' ? 'selected' : ''; ?>>All Participant Roles</option>
                    <option value="Employee" <?= $role_filter === 'Employee' ? 'selected' : ''; ?>>Employee Role</option>
                    <option value="Manager" <?= $role_filter === 'Manager' ? 'selected' : ''; ?>>Manager Role</option>
                    <option value="External" <?= $role_filter === 'External' ? 'selected' : ''; ?>>External Role</option>
                </select>

                <div class="relative w-full sm:w-60">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input type="text" name="search" value="<?= htmlspecialchars($search ? $search : ''); ?>" placeholder="Search name, email..." class="w-full h-9 pl-9 pr-3 rounded-full border border-outline-variant bg-surface-container-lowest text-xs focus:outline-none focus:border-primary"/>
                </div>
            </form>
        </div>

        <!-- Registration Cards -->
        <div class="space-y-6 mb-8">
            <?php if (!empty($registrations)): ?>
                <?php foreach ($registrations as $reg): ?>
                    <?php
                        $formDataObj = !empty($reg->form_data) ? json_decode($reg->form_data, true) : [];
                        $submittedDate = date('M d, Y - h:i A', strtotime($reg->created_at));
                    ?>
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 shadow-sm flex flex-col gap-6 relative">
                        <!-- Top Bar: Applicant Info & Badges -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-outline-variant pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-primary/10 text-primary font-bold text-base flex items-center justify-center flex-shrink-0">
                                    <?= strtoupper(substr($reg->user_name, 0, 1)); ?>
                                </div>
                                <div>
                                    <h3 class="font-bold text-base text-on-surface flex items-center gap-2">
                                        <?= htmlspecialchars($reg->user_name); ?>
                                        <span class="px-2 py-0.5 text-[10px] rounded-md font-bold bg-surface-container-high text-on-surface-variant">
                                            <?= htmlspecialchars($reg->user_role); ?>
                                        </span>
                                    </h3>
                                    <p class="text-xs text-on-surface-variant"><?= htmlspecialchars($reg->user_email); ?></p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 text-xs rounded-full font-bold bg-primary-fixed text-primary">
                                    <?= htmlspecialchars($reg->event_name); ?>
                                </span>
                                <?php
                                    $stBadge = 'bg-amber-100 text-amber-800';
                                    if ($reg->status === 'approved') $stBadge = 'bg-emerald-100 text-emerald-800';
                                    elseif ($reg->status === 'rejected') $stBadge = 'bg-red-100 text-red-800';
                                    elseif ($reg->status === 'waitlisted') $stBadge = 'bg-amber-100 text-amber-900';
                                ?>
                                <span class="px-3 py-1 text-xs rounded-full font-bold <?= $stBadge; ?>">
                                    Status: <?= ucfirst($reg->status); ?> (Level <?= $reg->current_approval_level; ?>)
                                </span>
                            </div>
                        </div>

                        <!-- Response Data Grid -->
                        <?php if (!empty($formDataObj) && is_array($formDataObj)): ?>
                            <div>
                                <h4 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-2">Form Answers</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 p-4 bg-surface-container-low rounded-xl border border-outline-variant/60">
                                    <?php foreach ($formDataObj as $k => $v): ?>
                                        <div>
                                            <span class="text-[10px] text-on-surface-variant font-medium uppercase block"><?= htmlspecialchars(str_replace('_', ' ', $k)); ?></span>
                                            <span class="text-xs font-semibold text-on-surface"><?= htmlspecialchars(is_array($v) ? implode(', ', $v) : $v); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Approval Audit Trail -->
                        <?php if (!empty($reg->approvals)): ?>
                            <div class="pt-2">
                                <h4 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-2">Audit History</h4>
                                <div class="space-y-2">
                                    <?php foreach ($reg->approvals as $log): ?>
                                        <div class="text-xs p-3 rounded-lg bg-surface-container-low border border-outline-variant/40 flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-[16px] <?= $log->status === 'approved' ? 'text-emerald-600' : 'text-error'; ?>">
                                                    <?= $log->status === 'approved' ? 'check_circle' : 'cancel'; ?>
                                                </span>
                                                <span class="font-bold text-on-surface"><?= htmlspecialchars($log->approver_name); ?> (<?= htmlspecialchars($log->approver_role); ?>):</span>
                                                <span class="text-on-surface-variant italic">"<?= htmlspecialchars($log->comments); ?>"</span>
                                            </div>
                                            <span class="text-[10px] text-on-surface-variant flex-shrink-0 ml-2"><?= date('M d, h:i A', strtotime($log->created_at)); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Action Forms for Pending Applications -->
                        <?php if ($reg->status === 'pending' || $reg->status === 'waitlisted'): ?>
                            <div class="pt-4 border-t border-outline-variant flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                                <span class="text-xs text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">schedule</span>
                                    Submitted on <?= $submittedDate; ?>
                                </span>

                                <div class="flex items-center gap-3">
                                    <!-- Reject Form -->
                                    <form method="POST" action="<?= site_url('approvals/reject/' . $reg->id); ?>" class="inline-flex gap-2">
                                        <input type="hidden" name="comments" value="Rejected by approver"/>
                                        <button type="submit" onclick="return confirm('Reject this application? (If rejected, next waitlisted candidate will be promoted)');" class="px-5 py-2 bg-error-container text-error hover:bg-error hover:text-white rounded-full font-bold text-xs transition-all flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">close</span>
                                            Reject
                                        </button>
                                    </form>

                                    <!-- Approve Form -->
                                    <form method="POST" action="<?= site_url('approvals/approve/' . $reg->id); ?>" class="inline-flex gap-2">
                                        <input type="hidden" name="comments" value="Approved by reviewer"/>
                                        <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full font-bold text-xs transition-all shadow-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">check</span>
                                            Approve Request
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="pt-2 border-t border-outline-variant flex justify-between items-center text-xs text-on-surface-variant">
                                <span>Submitted on <?= $submittedDate; ?></span>
                                <span class="font-semibold italic">Processing Complete</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="py-16 text-center text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-2xl">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2">fact_check</span>
                    <p class="font-bold text-base text-on-surface">No applications found under current filter.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination Controls -->
        <?php if ($total_pages > 1): ?>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-surface-container-lowest border border-outline-variant rounded-2xl p-4 shadow-sm">
                <div class="text-xs font-semibold text-on-surface-variant">
                    Showing <span class="text-on-surface font-bold"><?= min($total_records, ($page - 1) * $limit + 1); ?></span> to <span class="text-on-surface font-bold"><?= min($total_records, $page * $limit); ?></span> of <span class="text-on-surface font-bold"><?= $total_records; ?></span> applications
                </div>

                <div class="flex items-center gap-1.5">
                    <?php if ($page > 1): ?>
                        <a href="<?= site_url('approvals?status=' . urlencode($status_filter) . '&role=' . urlencode($role_filter) . '&search=' . urlencode($search) . '&page=' . ($page - 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">chevron_left</span> Previous
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="<?= site_url('approvals?status=' . urlencode($status_filter) . '&role=' . urlencode($role_filter) . '&search=' . urlencode($search) . '&page=' . $i); ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all <?= $i === $page ? 'bg-primary text-white shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high'; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="<?= site_url('approvals?status=' . urlencode($status_filter) . '&role=' . urlencode($role_filter) . '&search=' . urlencode($search) . '&page=' . ($page + 1)); ?>" class="px-3 py-1.5 rounded-full border border-outline-variant bg-surface-container-low hover:bg-surface-container-high text-xs font-semibold text-on-surface transition-all flex items-center gap-1">
                            Next <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
