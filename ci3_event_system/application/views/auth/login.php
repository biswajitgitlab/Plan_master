<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign In - EventCentral</title>
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
                        "error-container": "#ffdad6"
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
<body class="bg-[#f8fafc] text-on-surface font-body-md antialiased min-h-screen flex items-center justify-center p-4 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] relative overflow-x-hidden">
    <!-- Ambient Glow Orbs -->
    <div class="fixed top-0 right-0 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed bottom-0 left-0 w-[500px] h-[500px] bg-primary-container/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="w-full max-w-md bg-surface-container-lowest border border-outline-variant/80 rounded-2xl shadow-xl p-8 backdrop-blur-xl relative">
        <div class="flex items-center justify-center gap-2 mb-6">
            <span class="material-symbols-outlined text-primary text-4xl" data-weight="fill">event_available</span>
            <span class="font-headline-lg text-2xl font-bold text-primary">EventCentral</span>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-xl font-bold text-on-surface">Welcome Back</h1>
            <p class="text-xs text-on-surface-variant mt-1">Sign in to access corporate events, approval queues, and quotas.</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 p-4 bg-error-container text-on-error-container text-xs rounded-xl border border-error/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-error text-[18px]">error</span>
                <span><?= $this->session->flashdata('error'); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 text-xs rounded-xl border border-emerald-200 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                <span><?= $this->session->flashdata('success'); ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/login'); ?>" method="POST" class="space-y-5">
            <div>
                <label for="email" class="block text-xs font-semibold text-on-surface mb-1.5">Email Address</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">mail</span>
                    <input type="email" id="email" name="email" required placeholder="admin@example.com" class="w-full h-11 pl-10 pr-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"/>
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-on-surface mb-1.5">Password</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">lock</span>
                    <input type="password" id="password" name="password" required value="password" placeholder="••••••••" class="w-full h-11 pl-10 pr-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"/>
                </div>
            </div>

            <button type="submit" class="w-full h-11 bg-primary hover:bg-primary/90 text-white font-semibold text-sm rounded-full shadow-md transition-all flex items-center justify-center gap-2">
                <span>Sign In</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-outline-variant/60">
            <p class="text-[11px] text-center text-on-surface-variant font-medium mb-3">Demo Quick Sign-In Accounts (Password: <code class="bg-surface-container-high px-1 py-0.5 rounded text-primary">password</code>)</p>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <button type="button" onclick="fillForm('admin@example.com')" class="p-2 rounded bg-surface-container-low hover:bg-surface-container-high text-left transition-colors flex flex-col">
                    <span class="font-bold text-on-surface">System Admin</span>
                    <span class="text-[10px] text-on-surface-variant">admin@example.com</span>
                </button>
                <button type="button" onclick="fillForm('approver1@example.com')" class="p-2 rounded bg-surface-container-low hover:bg-surface-container-high text-left transition-colors flex flex-col">
                    <span class="font-bold text-on-surface">Sub-Admin (Approver)</span>
                    <span class="text-[10px] text-on-surface-variant">approver1@example.com</span>
                </button>
                <button type="button" onclick="fillForm('employee@example.com')" class="p-2 rounded bg-surface-container-low hover:bg-surface-container-high text-left transition-colors flex flex-col">
                    <span class="font-bold text-on-surface">Employee</span>
                    <span class="text-[10px] text-on-surface-variant">employee@example.com</span>
                </button>
                <button type="button" onclick="fillForm('external@example.com')" class="p-2 rounded bg-surface-container-low hover:bg-surface-container-high text-left transition-colors flex flex-col">
                    <span class="font-bold text-on-surface">External Registrant</span>
                    <span class="text-[10px] text-on-surface-variant">external@example.com</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        function fillForm(email) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = 'password';
        }
    </script>
</body>
</html>
