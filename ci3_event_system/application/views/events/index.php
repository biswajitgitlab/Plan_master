<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events - CI3 EventSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

<nav class="border-b border-slate-800 bg-slate-950/80 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('index.php/events'); ?>" class="text-xl font-bold text-indigo-400">EventCentral</a>
        <span class="text-xs bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full border border-indigo-500/30">CodeIgniter 3</span>
    </div>
    <div class="flex items-center space-x-4">
        <span class="text-sm text-slate-400">User: <strong class="text-white"><?= $this->session->userdata('name'); ?></strong> (<?= $this->session->userdata('role'); ?>)</span>
        <?php if ($this->session->userdata('role') === 'Admin'): ?>
            <a href="<?= base_url('index.php/admin'); ?>" class="text-xs bg-indigo-600 hover:bg-indigo-500 px-3 py-1.5 rounded transition">Admin Panel</a>
        <?php elseif ($this->session->userdata('role') === 'Sub-Admin'): ?>
            <a href="<?= base_url('index.php/approvals'); ?>" class="text-xs bg-amber-600 hover:bg-amber-500 px-3 py-1.5 rounded transition">Approver Panel</a>
        <?php endif; ?>
        <a href="<?= base_url('index.php/auth/logout'); ?>" class="text-xs bg-red-500/20 text-red-300 hover:bg-red-500/30 px-3 py-1.5 rounded transition">Logout</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold">Upcoming Enterprise Events</h1>
        <p class="text-slate-400 text-sm">Browse scheduled seminars, workshops, and trainings.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($events as $event): ?>
            <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-lg flex flex-col justify-between hover:border-indigo-500/50 transition">
                <div>
                    <h3 class="text-lg font-bold text-white mb-2"><?= html_escape($event->name); ?></h3>
                    <p class="text-slate-300 text-sm mb-4 line-clamp-3"><?= html_escape($event->description); ?></p>
                    <div class="flex items-center space-x-4 text-xs text-slate-400 mb-6">
                        <span>📅 <?= $event->start_date; ?> to <?= $event->end_date; ?></span>
                    </div>
                </div>
                <div>
                    <a href="<?= base_url('index.php/events/detail/' . $event->id); ?>" class="w-full block text-center bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 rounded-lg text-sm transition">
                        View & Register &rarr;
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
