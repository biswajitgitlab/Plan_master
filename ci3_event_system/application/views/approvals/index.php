<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approver Dashboard - CI3 EventSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

<nav class="border-b border-slate-800 bg-slate-950/80 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('index.php/approvals'); ?>" class="text-xl font-bold text-indigo-400">EventCentral</a>
        <span class="text-xs bg-amber-500/20 text-amber-300 px-2 py-0.5 rounded-full border border-amber-500/30">Approver Panel (CI3)</span>
    </div>
    <div class="flex items-center space-x-4">
        <span class="text-sm text-slate-400">Approver: <strong class="text-white"><?= $this->session->userdata('name'); ?></strong></span>
        <a href="<?= base_url('index.php/auth/logout'); ?>" class="text-xs bg-red-500/20 text-red-300 hover:bg-red-500/30 px-3 py-1.5 rounded transition">Logout</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold">Registration Approval Pipeline</h1>
            <p class="text-slate-400 text-sm">Review, approve, or reject participant registrations for your assigned approval level.</p>
        </div>

        <!-- Filter tabs -->
        <div class="flex items-center space-x-2 bg-slate-800 p-1.5 rounded-lg border border-slate-700">
            <a href="<?= base_url('index.php/approvals?status=pending'); ?>" class="px-3 py-1.5 rounded-md text-xs font-semibold <?= $status_filter === 'pending' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-200'; ?>">Pending</a>
            <a href="<?= base_url('index.php/approvals?status=approved'); ?>" class="px-3 py-1.5 rounded-md text-xs font-semibold <?= $status_filter === 'approved' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-200'; ?>">Approved</a>
            <a href="<?= base_url('index.php/approvals?status=rejected'); ?>" class="px-3 py-1.5 rounded-md text-xs font-semibold <?= $status_filter === 'rejected' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-200'; ?>">Rejected</a>
            <a href="<?= base_url('index.php/approvals?status=waitlisted'); ?>" class="px-3 py-1.5 rounded-md text-xs font-semibold <?= $status_filter === 'waitlisted' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-200'; ?>">Waitlisted</a>
            <a href="<?= base_url('index.php/approvals?status=all'); ?>" class="px-3 py-1.5 rounded-md text-xs font-semibold <?= $status_filter === 'all' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-200'; ?>">All</a>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (empty($registrations)): ?>
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-12 text-center text-slate-400">
            No registrations found for status filter: <strong class="text-white"><?= html_escape($status_filter); ?></strong>
        </div>
    <?php else: ?>
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl overflow-hidden shadow-xl">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/80 uppercase text-xs text-slate-400 font-semibold border-b border-slate-700">
                    <tr>
                        <th class="px-6 py-4">Event</th>
                        <th class="px-6 py-4">Participant</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Form Responses</th>
                        <th class="px-6 py-4">Status / Level</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    <?php foreach ($registrations as $reg): ?>
                        <tr class="hover:bg-slate-750/50 transition">
                            <td class="px-6 py-4 font-semibold text-white"><?= html_escape($reg->event_name); ?></td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-100"><?= html_escape($reg->user_name); ?></div>
                                <div class="text-xs text-slate-400"><?= html_escape($reg->user_email); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-slate-700 text-slate-200 text-xs px-2.5 py-1 rounded border border-slate-600">
                                    <?= html_escape($reg->user_role); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-300">
                                <?php 
                                $formData = json_decode($reg->form_data, true);
                                if (!empty($formData) && is_array($formData)):
                                    foreach ($formData as $k => $v):
                                        echo "<div><strong>" . html_escape($k) . ":</strong> " . html_escape($v) . "</div>";
                                    endforeach;
                                else:
                                    echo "<span class='text-slate-500'>Standard Registration</span>";
                                endif;
                                ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($reg->status === 'approved'): ?>
                                    <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs px-2.5 py-1 rounded-full font-semibold">Approved</span>
                                <?php elseif ($reg->status === 'pending'): ?>
                                    <span class="bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs px-2.5 py-1 rounded-full font-semibold">Pending (L<?= $reg->current_approval_level; ?>)</span>
                                <?php elseif ($reg->status === 'waitlisted'): ?>
                                    <span class="bg-sky-500/20 text-sky-300 border border-sky-500/30 text-xs px-2.5 py-1 rounded-full font-semibold">Waitlisted</span>
                                <?php else: ?>
                                    <span class="bg-red-500/20 text-red-300 border border-red-500/30 text-xs px-2.5 py-1 rounded-full font-semibold">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <?php if ($reg->status === 'pending'): ?>
                                    <form action="<?= base_url('index.php/approvals/approve/' . $reg->id); ?>" method="POST" class="inline">
                                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs px-3 py-1.5 rounded transition font-semibold">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="<?= base_url('index.php/approvals/reject/' . $reg->id); ?>" method="POST" class="inline">
                                        <button type="submit" onclick="return confirm('Reject this registration? (Will check waitlist)');" class="bg-red-600 hover:bg-red-500 text-white text-xs px-3 py-1.5 rounded transition font-semibold">
                                            Reject
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-xs text-slate-500">Processed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
