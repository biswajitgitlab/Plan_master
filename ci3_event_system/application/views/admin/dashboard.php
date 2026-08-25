<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CI3 EventSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

<nav class="border-b border-slate-800 bg-slate-950/80 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <span class="text-xl font-bold text-indigo-400">EventCentral</span>
        <span class="text-xs bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full border border-indigo-500/30">CodeIgniter 3 Admin</span>
    </div>
    <div class="flex items-center space-x-4">
        <span class="text-sm text-slate-400">Logged in as: <strong class="text-white"><?= $this->session->userdata('name'); ?></strong></span>
        <a href="<?= base_url('index.php/auth/logout'); ?>" class="text-xs bg-red-500/20 text-red-300 hover:bg-red-500/30 px-3 py-1.5 rounded transition">Logout</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold">Event Management</h1>
            <p class="text-slate-400 text-sm">Create events, configure role quotas, and establish approval bands.</p>
        </div>
        <a href="<?= base_url('index.php/admin/create_event'); ?>" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2.5 rounded-lg text-sm transition">
            + Create New Event
        </a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($events as $event): ?>
            <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-lg flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white mb-2"><?= html_escape($event->name); ?></h3>
                    <p class="text-slate-300 text-sm line-clamp-3 mb-4"><?= html_escape($event->description); ?></p>
                    <div class="flex items-center space-x-4 text-xs text-slate-400 mb-4">
                        <span>📅 <?= $event->start_date; ?> to <?= $event->end_date; ?></span>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-700/60 flex items-center justify-between">
                    <a href="<?= base_url('index.php/events/detail/' . $event->id); ?>" class="text-xs text-indigo-400 hover:underline">View Public Page &rarr;</a>
                    <a href="<?= base_url('index.php/admin/delete_event/' . $event->id); ?>" onclick="return confirm('Delete this event?');" class="text-xs text-red-400 hover:underline">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
