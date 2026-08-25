<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - CodeIgniter 3</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

<nav class="border-b border-slate-800 bg-slate-950/80 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('index.php/admin'); ?>" class="text-xl font-bold text-indigo-400">EventCentral</a>
        <span class="text-xs bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full border border-indigo-500/30">Create Event</span>
    </div>
</nav>

<div class="max-w-4xl mx-auto px-6 py-8">
    <div class="mb-6">
        <a href="<?= base_url('index.php/admin'); ?>" class="text-xs text-indigo-400 hover:underline">&larr; Back to Admin Dashboard</a>
        <h1 class="text-2xl font-bold mt-2">Create New Event</h1>
    </div>

    <form action="<?= base_url('index.php/admin/store_event'); ?>" method="POST" id="eventForm" class="space-y-8">
        
        <!-- Section 1: Details -->
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-md space-y-4">
            <h2 class="text-lg font-semibold text-white border-b border-slate-700 pb-2">1. Basic Event Details</h2>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-400 mb-1">Event Name</label>
                <input type="text" name="name" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-400 mb-1">Description</label>
                <textarea name="description" rows="3" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-100 focus:outline-none focus:border-indigo-500"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-400 mb-1">Start Date</label>
                    <input type="date" name="start_date" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-400 mb-1">End Date</label>
                    <input type="date" name="end_date" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                </div>
            </div>
        </div>

        <!-- Section 2: Quotas per Role -->
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-md">
            <div class="flex items-center justify-between border-b border-slate-700 pb-2 mb-4">
                <h2 class="text-lg font-semibold text-white">2. Participant Quotas per Role</h2>
                <button type="button" id="addQuotaRow" class="text-xs bg-indigo-600/30 hover:bg-indigo-600/50 text-indigo-300 px-3 py-1.5 rounded border border-indigo-500/40">
                    + Add Role Quota
                </button>
            </div>
            <div id="quotaContainer" class="space-y-3">
                <div class="grid grid-cols-12 gap-3 items-center quota-row">
                    <div class="col-span-6">
                        <select name="quota_role[]" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                            <option value="Employee">Employee</option>
                            <option value="Manager">Manager</option>
                            <option value="External">External</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="col-span-5">
                        <input type="number" name="quota_limit[]" placeholder="Capacity Limit" value="10" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                    </div>
                    <div class="col-span-1 text-center">
                        <button type="button" class="remove-row text-red-400 hover:text-red-300 text-sm">&times;</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Approval Bands -->
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-md">
            <div class="flex items-center justify-between border-b border-slate-700 pb-2 mb-4">
                <h2 class="text-lg font-semibold text-white">3. Approval Bands (Sequence)</h2>
                <button type="button" id="addBandRow" class="text-xs bg-indigo-600/30 hover:bg-indigo-600/50 text-indigo-300 px-3 py-1.5 rounded border border-indigo-500/40">
                    + Add Approval Level
                </button>
            </div>
            <div id="bandContainer" class="space-y-3">
                <div class="grid grid-cols-12 gap-3 items-center band-row">
                    <div class="col-span-2 text-xs font-semibold text-slate-400">Level 1</div>
                    <div class="col-span-9">
                        <select name="band_role[]" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                            <option value="Sub-Admin">Sub-Admin (Approver)</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-span-1 text-center">
                        <button type="button" class="remove-row text-red-400 hover:text-red-300 text-sm">&times;</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 4: Dynamic Form Builder -->
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-md">
            <h2 class="text-lg font-semibold text-white border-b border-slate-700 pb-2 mb-4">4. Dynamic Registration Form Fields</h2>
            <div class="flex items-center space-x-3 mb-4">
                <input type="text" id="fieldName" placeholder="Field Label (e.g. T-Shirt Size)" class="flex-1 bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                <select id="fieldType" class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                    <option value="text">Text Input</option>
                    <option value="select">Dropdown Select</option>
                </select>
                <button type="button" id="addFieldBtn" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs px-4 py-2.5 rounded-lg">
                    Add Field
                </button>
            </div>
            <div id="dynamicFieldsPreview" class="space-y-2 mb-4">
                <!-- Dynamic Field Badges -->
            </div>
            <input type="hidden" name="form_schema" id="formSchemaInput" value="[]">
        </div>

        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl transition shadow-lg">
            Publish Event
        </button>
    </form>
</div>

<script>
let dynamicFields = [];

function updateSchemaInput() {
    $('#formSchemaInput').val(JSON.stringify(dynamicFields));
    renderFieldsPreview();
}

function renderFieldsPreview() {
    const $container = $('#dynamicFieldsPreview');
    $container.empty();
    dynamicFields.forEach((field, index) => {
        $container.append(`
            <div class="flex items-center justify-between bg-slate-900 p-3 rounded-lg border border-slate-700/60 text-xs">
                <div>
                    <strong class="text-slate-200">${field.label}</strong>
                    <span class="text-slate-400 font-mono ml-2">(${field.type})</span>
                </div>
                <button type="button" onclick="removeField(${index})" class="text-red-400 hover:underline">Remove</button>
            </div>
        `);
    });
}

function removeField(index) {
    dynamicFields.splice(index, 1);
    updateSchemaInput();
}

$(document).ready(function() {
    $('#addFieldBtn').click(function() {
        const label = $('#fieldName').val().trim();
        const type = $('#fieldType').val();
        if (!label) return alert('Enter a field label');

        const key = label.toLowerCase().replace(/[^a-z0-9]/g, '_');
        dynamicFields.push({ name: key, label: label, type: type, required: true, options: type === 'select' ? ['Option A', 'Option B'] : [] });
        $('#fieldName').val('');
        updateSchemaInput();
    });

    $('#addQuotaRow').click(function() {
        $('#quotaContainer').append(`
            <div class="grid grid-cols-12 gap-3 items-center quota-row">
                <div class="col-span-6">
                    <select name="quota_role[]" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                        <option value="Employee">Employee</option>
                        <option value="Manager">Manager</option>
                        <option value="External">External</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="col-span-5">
                    <input type="number" name="quota_limit[]" placeholder="Capacity Limit" value="10" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                </div>
                <div class="col-span-1 text-center">
                    <button type="button" class="remove-row text-red-400 hover:text-red-300 text-sm">&times;</button>
                </div>
            </div>
        `);
    });

    $('#addBandRow').click(function() {
        const level = $('.band-row').length + 1;
        $('#bandContainer').append(`
            <div class="grid grid-cols-12 gap-3 items-center band-row">
                <div class="col-span-2 text-xs font-semibold text-slate-400">Level ${level}</div>
                <div class="col-span-9">
                    <select name="band_role[]" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-100">
                        <option value="Sub-Admin">Sub-Admin (Approver)</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="col-span-1 text-center">
                    <button type="button" class="remove-row text-red-400 hover:text-red-300 text-sm">&times;</button>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('.grid').remove();
    });
});
</script>

</body>
</html>
