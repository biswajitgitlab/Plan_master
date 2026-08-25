<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EventCentral - Authentication</title>

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined[data-weight="fill"] { font-variation-settings: 'FILL' 1; }
    </style>
</head>
<body class="bg-[#f8fafc] text-on-surface font-sans antialiased min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-hidden bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px]">
    
    <!-- Stylish Ambient Background Orbs -->
    <div class="fixed -top-32 -left-32 w-96 h-96 bg-primary/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-40 -right-32 w-[500px] h-[500px] bg-primary-container/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Header Branding -->
    <div class="mb-8 flex flex-col items-center text-center relative z-10">
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-white shadow-lg shadow-primary/20 group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[28px]" data-weight="fill">event_available</span>
            </div>
            <span class="font-bold text-2xl tracking-tight text-primary">EventCentral</span>
        </a>
        <p class="text-xs text-on-surface-variant mt-2 font-medium">Dynamic Event Registration & Quota Management Platform</p>
    </div>

    <!-- Auth Form Card with Glassmorphism -->
    <div class="w-full sm:max-w-md bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] rounded-2xl p-6 sm:p-8 relative z-10">
        {{ $slot }}
    </div>

    <!-- Footer Links -->
    <div class="mt-8 text-center text-xs text-on-surface-variant relative z-10">
        &copy; {{ date('Y') }} EventCentral Enterprise. All rights reserved.
    </div>

</body>
</html>

