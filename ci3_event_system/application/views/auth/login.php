<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reliant Enterprise Event Portal (CI3)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">

<div class="max-w-md w-full bg-slate-800 border border-slate-700 rounded-xl p-8 shadow-2xl">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-indigo-600/20 text-indigo-400 rounded-xl mb-3 border border-indigo-500/30">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h2 class="text-2xl font-bold tracking-tight text-white">EventCentral (CodeIgniter 3)</h2>
        <p class="text-slate-400 text-sm mt-1">Dynamic Registration & Quota System</p>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-3 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-3 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/auth/login'); ?>" method="POST" class="space-y-5">
        <div>
            <label class="block text-xs font-semibold uppercase text-slate-400 mb-2">Email Address</label>
            <input type="email" id="email" name="email" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-indigo-500 text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-slate-400 mb-2">Password</label>
            <input type="password" id="password" name="password" required value="password" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-indigo-500 text-sm">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 rounded-lg transition text-sm">
            Sign In
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-slate-700/60">
        <p class="text-xs text-slate-400 font-semibold uppercase mb-3 text-center">Quick Account Fill</p>
        <div class="grid grid-cols-2 gap-2 text-xs">
            <button onclick="fillLogin('admin@example.com')" class="bg-slate-700/60 hover:bg-slate-700 text-indigo-300 p-2 rounded text-left border border-slate-600/40">
                👤 Admin
            </button>
            <button onclick="fillLogin('approver1@example.com')" class="bg-slate-700/60 hover:bg-slate-700 text-amber-300 p-2 rounded text-left border border-slate-600/40">
                🛡️ Approver L1
            </button>
            <button onclick="fillLogin('employee@example.com')" class="bg-slate-700/60 hover:bg-slate-700 text-emerald-300 p-2 rounded text-left border border-slate-600/40">
                💼 Employee
            </button>
            <button onclick="fillLogin('external@example.com')" class="bg-slate-700/60 hover:bg-slate-700 text-cyan-300 p-2 rounded text-left border border-slate-600/40">
                🌐 External User
            </button>
        </div>
    </div>
</div>

<script>
function fillLogin(email) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = 'password';
}
</script>

</body>
</html>
