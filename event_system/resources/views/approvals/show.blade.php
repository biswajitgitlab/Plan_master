<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Approvals - EventCentral</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed": "#d8e2ff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-tertiary-fixed": "#341100",
                        "tertiary-fixed-dim": "#ffb691",
                        "surface-container": "#eceef0",
                        "surface-container-high": "#e6e8ea",
                        "primary-container": "#1a73e8",
                        "surface-container-low": "#f2f4f6",
                        "on-primary-fixed-variant": "#004493",
                        "error-container": "#ffdad6",
                        "on-surface": "#191c1e",
                        "primary-fixed-dim": "#adc7ff",
                        "on-surface-variant": "#414754",
                        "secondary-fixed": "#d5e3fc",
                        "inverse-surface": "#2d3133",
                        "inverse-on-surface": "#eff1f3",
                        "on-secondary": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "secondary-container": "#d5e3fc",
                        "tertiary": "#9e4300",
                        "on-background": "#191c1e",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#adc7ff",
                        "primary": "#005bbf",
                        "on-secondary-container": "#57657a",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-bright": "#f7f9fb",
                        "background": "#f7f9fb",
                        "surface-container-highest": "#e0e3e5",
                        "outline-variant": "#c1c6d6",
                        "on-tertiary-fixed-variant": "#783100",
                        "on-tertiary-container": "#0e0200",
                        "on-error": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#ffffff",
                        "tertiary-fixed": "#ffdbcb",
                        "outline": "#727785",
                        "on-primary-fixed": "#001a41",
                        "secondary": "#515f74",
                        "on-secondary-fixed": "#0d1c2e",
                        "tertiary-container": "#c55500",
                        "on-primary": "#ffffff",
                        "surface-dim": "#d8dadc",
                        "on-tertiary": "#ffffff",
                        "surface-tint": "#005bc0",
                        "surface": "#f7f9fb",
                        "error": "#ba1a1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "container-padding": "24px",
                        "stack-sm": "8px",
                        "gutter": "16px",
                        "unit": "4px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "label-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-lg": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined[data-weight="fill"] {
            font-variation-settings: 'FILL' 1;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col md:flex-row">
<!-- Mobile Top App Bar (Only visible on md:hidden) -->
<header class="md:hidden bg-surface-container-lowest text-primary font-headline-md font-bold sticky top-0 w-full z-40 border-b border-outline-variant shadow-sm px-container-padding h-16 flex justify-between items-center">
<div class="flex items-center gap-2 cursor-pointer active:opacity-80">
<span class="material-symbols-outlined text-primary" data-icon="event_available">event_available</span>
<span>EventCentral</span>
</div>
<div class="h-8 w-8 rounded-full bg-surface-variant overflow-hidden cursor-pointer active:opacity-80">
<img class="w-full h-full object-cover" data-alt="A small, professional headshot of an event coordinator named Alex, smiling slightly in a bright, modern office setting. Light mode aesthetic with soft, diffused lighting and neutral tones. The image is cropped closely to the face, suitable for an avatar." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC519TZskIuvjeqQesAN9xPfZx56M_vHN57ZiL4UsUn0s_q3T93A6-qynWI0nZCbNmD4_ZOgXJPFkj59-zfB1i3VKvZPjsUvRed1HruErXMTiOAkVOCo2DBlHUj2_g-1ISW3WeUx89aO6Of5INOZvJ5saI0hZdeWZm7s_Q2SPVE7j2V1EaPu_EPbf9fTlR93laYmb8lqq2LuaCsJbS_P2J54HC-SCzWDGJvdAkZVXu6H1t5_FL395Jp"/>
</div>
</header>
<!-- Side Navigation (Web only) -->
<nav class="hidden md:flex flex-col h-screen w-72 fixed left-0 top-0 bg-surface-container border-r border-outline-variant p-4 gap-stack-sm z-30 transition-all duration-200 ease-in-out">
<!-- Header -->
<div class="flex items-center gap-3 p-4 mb-4">
<div class="h-10 w-10 rounded-full bg-surface-variant overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A small, professional headshot of an event coordinator named Alex, smiling slightly in a bright, modern office setting. Light mode aesthetic with soft, diffused lighting and neutral tones. The image is cropped closely to the face, suitable for an avatar." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCiT7JLgGarr2ekWdcyxCxt2RRdsTcTsHygLxnWU7ldqqCVfVj0j4dUroS-yv5gRdEGVrlEJIP7hSh4g4tGjH6tuCxKeox9AgPSDTGaTqirw1Ih60Nb7pNjsstFaZzTNzmfgzmnU5XKG6OgaW4WZhSxjj0Z0_eVoE5Bfo7Grw2p8VDFIaXwTdp4nEQ8BFDBqdKOizrKXfghGepvBOKav7d5MRMlnmIpQAwJ-vg8vwf6f38-wDEnU67U"/>
</div>
<div>
<div class="font-label-md text-label-md text-on-surface">Alex Coordinator</div>
<div class="font-body-md text-body-md text-on-surface-variant text-[10px]">Admin Role</div>
</div>
</div>
<!-- Navigation Links -->
<a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            Dashboard
        </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
            Events
        </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-full bg-primary-container text-on-primary-container font-label-md text-label-md" href="#">
<span class="material-symbols-outlined" data-icon="fact_check" data-weight="fill">fact_check</span>
            Approvals
        </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md mt-auto" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
            Settings
        </a>
</nav>
<!-- Main Content Area -->
<main class="flex-1 md:ml-72 p-container-padding max-w-[1440px] mx-auto w-full pb-24 md:pb-container-padding">
<!-- Page Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-stack-lg gap-4">
<div>
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-1">Approvals Dashboard</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Review and manage pending registration requests.</p>
</div>
<div class="flex items-center gap-2 bg-surface-container-low border border-outline-variant px-4 py-2 rounded-full">
<span class="material-symbols-outlined text-primary" data-icon="pending_actions">pending_actions</span>
<span class="font-label-md text-label-md text-on-surface">12 Pending Reviews</span>
</div>
</div>
<!-- Filters & Search -->
<div class="flex flex-col sm:flex-row gap-4 mb-stack-md bg-surface-container-lowest p-4 rounded-xl border border-outline-variant shadow-sm">
<div class="flex-1 relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant" placeholder="Search by name or email..." type="text"/>
</div>
<div class="relative min-w-[200px]">
<select class="w-full appearance-none pl-4 pr-10 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 font-body-md text-body-md text-on-surface cursor-pointer">
<option value="all">All Events</option>
<option value="annual-gala">Annual Corporate Gala 2024</option>
<option value="tech-summit">Global Tech Summit</option>
<option value="leadership">Leadership Retreat</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none" data-icon="expand_more">expand_more</span>
</div>
</div>
<!-- Approvals List (Bento-style Grid for Web, Stack for Mobile) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-md">
<!-- Request Card 1 -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_3px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col hover:shadow-md transition-shadow">
<div class="p-4 flex justify-between items-start border-b border-outline-variant/50 bg-surface-bright">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-headline-md text-headline-md font-bold">
                            JS
                        </div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">John Smith</h3>
<p class="font-body-md text-body-md text-on-surface-variant">john.smith@example.com</p>
</div>
</div>
<span class="px-3 py-1 bg-[#fff3e0] text-[#e65100] rounded-full font-label-md text-label-md border border-[#ffe0b2]">Pending</span>
</div>
<div class="p-4 flex-1">
<div class="grid grid-cols-2 gap-4 mb-4">
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Event</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Annual Corporate Gala 2024</p>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Requested Role</p>
<p class="font-body-md text-body-md text-on-surface">VIP Guest</p>
</div>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Additional Notes</p>
<p class="font-body-md text-body-md text-on-surface italic text-sm">"I require vegetarian meal options."</p><div class="mt-6 pt-4 border-t border-outline-variant/30">
<p class="font-label-md text-label-md text-on-surface-variant mb-4 uppercase tracking-wider">Approval Progress</p>
<div class="flex items-center gap-0">
<!-- Step 1: Approved -->
<div class="flex flex-col items-center flex-1 relative">
<div class="w-8 h-8 rounded-full bg-[#e8f5e9] border border-[#c8e6c9] flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[#2e7d32] text-[18px]" data-weight="fill">check_circle</span>
</div>
<div class="absolute top-4 left-1/2 w-full h-[2px] bg-[#c8e6c9]"></div>
<span class="mt-2 font-label-md text-[10px] text-on-surface text-center">Dept. Head</span>
</div>
<!-- Step 2: Pending -->
<div class="flex flex-col items-center flex-1 relative">
<div class="w-8 h-8 rounded-full bg-[#fff3e0] border border-[#ffe0b2] flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[#e65100] text-[18px] animate-spin">progress_activity</span>
</div>
<div class="absolute top-4 left-1/2 w-full h-[2px] bg-outline-variant/30"></div>
<span class="mt-2 font-label-md text-[10px] text-on-surface text-center">Finance</span>
</div>
<!-- Step 3: Future -->
<div class="flex flex-col items-center flex-1 relative">
<div class="w-8 h-8 rounded-full bg-surface-container border border-outline-variant/50 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-outline text-[18px]">circle</span>
</div>
<span class="mt-2 font-label-md text-[10px] text-on-surface-variant text-center">Final Admin</span>
</div>
</div>
</div>
</div>
</div>
<div class="p-4 bg-surface-container-lowest border-t border-outline-variant/50 flex justify-end gap-3">
<button class="px-6 py-2 bg-surface-container-lowest border border-error text-error hover:bg-error-container transition-colors rounded-full font-label-md text-label-md flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="close">close</span> Reject
                    </button>
<button class="px-6 py-2 bg-[#e8f5e9] border border-[#c8e6c9] text-[#2e7d32] hover:bg-[#c8e6c9] transition-colors rounded-full font-label-md text-label-md flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="check">check</span> Approve
                    </button>
</div>
</div>
<!-- Request Card 2 -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_3px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col hover:shadow-md transition-shadow">
<div class="p-4 flex justify-between items-start border-b border-outline-variant/50 bg-surface-bright">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-headline-md text-headline-md font-bold">
                            EM
                        </div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Emily Chen</h3>
<p class="font-body-md text-body-md text-on-surface-variant">emily.c@techcorp.com</p>
</div>
</div>
<span class="px-3 py-1 bg-[#fff3e0] text-[#e65100] rounded-full font-label-md text-label-md border border-[#ffe0b2]">Pending</span>
</div>
<div class="p-4 flex-1">
<div class="grid grid-cols-2 gap-4 mb-4">
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Event</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Global Tech Summit</p>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Requested Role</p>
<p class="font-body-md text-body-md text-on-surface">Speaker</p>
</div>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Additional Notes</p>
<p class="font-body-md text-body-md text-on-surface italic text-sm">"Need dual projector setup for presentation."</p><div class="mt-6 pt-4 border-t border-outline-variant/30">
<p class="font-label-md text-label-md text-on-surface-variant mb-4 uppercase tracking-wider">Approval Progress</p>
<div class="flex items-center gap-0">
<div class="flex flex-col items-center flex-1 relative">
<div class="w-8 h-8 rounded-full bg-[#e8f5e9] border border-[#c8e6c9] flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[#2e7d32] text-[18px]" data-weight="fill">check_circle</span>
</div>
<div class="absolute top-4 left-1/2 w-full h-[2px] bg-[#c8e6c9]"></div>
<span class="mt-2 font-label-md text-[10px] text-on-surface text-center">Dept. Head</span>
</div>
<div class="flex flex-col items-center flex-1 relative">
<div class="w-8 h-8 rounded-full bg-[#fff3e0] border border-[#ffe0b2] flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[#e65100] text-[18px] animate-spin">progress_activity</span>
</div>
<div class="absolute top-4 left-1/2 w-full h-[2px] bg-outline-variant/30"></div>
<span class="mt-2 font-label-md text-[10px] text-on-surface text-center">Finance</span>
</div>
<div class="flex flex-col items-center flex-1 relative">
<div class="w-8 h-8 rounded-full bg-surface-container border border-outline-variant/50 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-outline text-[18px]">circle</span>
</div>
<span class="mt-2 font-label-md text-[10px] text-on-surface-variant text-center">Final Admin</span>
</div>
</div>
</div>
</div>
</div>
<div class="p-4 bg-surface-container-lowest border-t border-outline-variant/50 flex justify-end gap-3">
<button class="px-6 py-2 bg-surface-container-lowest border border-error text-error hover:bg-error-container transition-colors rounded-full font-label-md text-label-md flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="close">close</span> Reject
                    </button>
<button class="px-6 py-2 bg-[#e8f5e9] border border-[#c8e6c9] text-[#2e7d32] hover:bg-[#c8e6c9] transition-colors rounded-full font-label-md text-label-md flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="check">check</span> Approve
                    </button>
</div>
</div>
<!-- Status Example: Approved (Read-only state) -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_3px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col opacity-75">
<div class="p-4 flex justify-between items-start border-b border-outline-variant/50 bg-surface-bright">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-variant text-on-surface-variant flex items-center justify-center font-headline-md text-headline-md font-bold">
                            MR
                        </div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface line-through decoration-outline-variant">Michael Ross</h3>
<p class="font-body-md text-body-md text-on-surface-variant">m.ross@lawfirm.com</p>
</div>
</div>
<span class="px-3 py-1 bg-[#e8f5e9] text-[#2e7d32] rounded-full font-label-md text-label-md border border-[#c8e6c9]">Approved</span>
</div>
<div class="p-4 flex-1">
<div class="grid grid-cols-2 gap-4">
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Event</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Leadership Retreat</p>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Role</p>
<p class="font-body-md text-body-md text-on-surface">Attendee</p>
</div>
</div>
</div>
</div>
<!-- Status Example: Waitlisted (Read-only state) -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_3px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col opacity-75">
<div class="p-4 flex justify-between items-start border-b border-outline-variant/50 bg-surface-bright">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-variant text-on-surface-variant flex items-center justify-center font-headline-md text-headline-md font-bold">
                            SL
                        </div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Sarah Lee</h3>
<p class="font-body-md text-body-md text-on-surface-variant">sarah.lee@startup.io</p>
</div>
</div>
<span class="px-3 py-1 bg-surface-container-highest text-on-surface-variant rounded-full font-label-md text-label-md border border-outline-variant">Waitlisted</span>
</div>
<div class="p-4 flex-1">
<div class="grid grid-cols-2 gap-4">
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Event</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Global Tech Summit</p>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Role</p>
<p class="font-body-md text-body-md text-on-surface">Attendee</p>
</div>
</div>
</div>
<div class="p-4 bg-surface-container-lowest border-t border-outline-variant/50 flex justify-end gap-3">
<button class="px-4 py-2 bg-surface-container-lowest border border-outline-variant text-on-surface-variant hover:bg-surface-container-low transition-colors rounded-full font-label-md text-label-md">
                        Promote to Approved
                    </button>
</div>
</div>
</div>
</main>
<!-- Mobile Bottom Nav Bar (md:hidden) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-3 bg-surface-container-lowest border-t border-outline-variant shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] rounded-t-xl">
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high active:scale-95 transition-transform px-4 py-1 rounded-full" href="#">
<span class="material-symbols-outlined mb-1" data-icon="search">search</span>
<span class="font-label-md text-label-md">Browse</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high active:scale-95 transition-transform px-4 py-1 rounded-full" href="#">
<span class="material-symbols-outlined mb-1" data-icon="event_note">event_note</span>
<span class="font-label-md text-label-md">My Events</span>
</a>
<a class="flex flex-col items-center justify-center bg-secondary-container text-on-secondary-container rounded-full px-4 py-1 active:scale-95 transition-transform relative" href="#">
<span class="absolute top-1 right-3 w-2 h-2 bg-error rounded-full"></span>
<span class="material-symbols-outlined mb-1" data-icon="notifications" data-weight="fill">notifications</span>
<span class="font-label-md text-label-md">Inbox</span>
</a>
</nav>
</body></html>