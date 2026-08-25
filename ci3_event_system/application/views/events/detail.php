<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($event->name); ?> - CI3 Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

<nav class="border-b border-slate-800 bg-slate-950/80 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('index.php/events'); ?>" class="text-xl font-bold text-indigo-400">EventCentral</a>
        <span class="text-xs bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full border border-indigo-500/30">CI3 Registration</span>
    </div>
</nav>

<div class="max-w-4xl mx-auto px-6 py-8">
    <a href="<?= base_url('index.php/events'); ?>" class="text-xs text-indigo-400 hover:underline">&larr; Back to Events List</a>

    <div class="mt-4 bg-slate-800 border border-slate-700/80 rounded-xl p-8 shadow-xl mb-8">
        <h1 class="text-3xl font-bold text-white mb-3"><?= html_escape($event->name); ?></h1>
        <p class="text-slate-300 text-sm leading-relaxed mb-6"><?= html_escape($event->description); ?></p>
        
        <div class="flex items-center space-x-6 text-xs text-slate-400 border-t border-slate-700/60 pt-4">
            <div>📅 Start: <strong class="text-slate-200"><?= $event->start_date; ?></strong></div>
            <div>🏁 End: <strong class="text-slate-200"><?= $event->end_date; ?></strong></div>
        </div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-4 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('warning')): ?>
        <div class="bg-amber-500/10 border border-amber-500/50 text-amber-400 p-4 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('warning'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-lg text-sm mb-6">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Quotas Breakdown -->
    <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-6 shadow-md mb-8">
        <h3 class="text-sm font-semibold uppercase text-slate-400 mb-3">Role Quotas & Availability</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <?php foreach ($quotas as $quota): ?>
                <div class="bg-slate-900 border border-slate-700 p-3 rounded-lg text-center">
                    <span class="text-xs text-slate-400 uppercase block"><?= html_escape($quota->role_name); ?></span>
                    <strong class="text-lg text-indigo-400"><?= $quota->quota_limit; ?> Seats</strong>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Registration Status or Form -->
    <?php if ($registration): ?>
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-8 text-center">
            <h3 class="text-lg font-bold text-white mb-2">Your Registration Status</h3>
            <?php if ($registration->status === 'approved'): ?>
                <span class="inline-block bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 px-4 py-2 rounded-full text-sm font-bold">
                    ✅ Fully Approved
                </span>
            <?php elseif ($registration->status === 'pending'): ?>
                <span class="inline-block bg-amber-500/20 text-amber-300 border border-amber-500/40 px-4 py-2 rounded-full text-sm font-bold">
                    ⏳ Pending Approval (Level <?= $registration->current_approval_level; ?>)
                </span>
            <?php elseif ($registration->status === 'waitlisted'): ?>
                <span class="inline-block bg-sky-500/20 text-sky-300 border border-sky-500/40 px-4 py-2 rounded-full text-sm font-bold">
                    📋 Placed on Waitlist
                </span>
            <?php elseif ($registration->status === 'rejected'): ?>
                <span class="inline-block bg-red-500/20 text-red-300 border border-red-500/40 px-4 py-2 rounded-full text-sm font-bold">
                    ❌ Registration Rejected
                </span>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="bg-slate-800 border border-slate-700/80 rounded-xl p-8 shadow-xl">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-700 pb-3">Event Registration Form</h2>
            
            <form action="<?= base_url('index.php/events/register/' . $event->id); ?>" method="POST" id="regForm" class="space-y-6">
                
                <!-- Dynamic Fields Container -->
                <?php 
                $fields = json_decode($event->form_schema, true);
                if (!empty($fields) && is_array($fields)):
                    foreach ($fields as $field): 
                ?>
                    <div>
                        <label class="block text-xs font-semibold uppercase text-slate-300 mb-2">
                            <?= html_escape($field['label']); ?>
                            <?php if (!empty($field['required'])): ?><span class="text-red-400">*</span><?php endif; ?>
                        </label>

                        <?php if ($field['type'] === 'select'): ?>
                            <select name="dynamic_field[<?= $field['name']; ?>]" <?= !empty($field['required']) ? 'required' : ''; ?> class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-100 focus:border-indigo-500">
                                <option value="">Select an option</option>
                                <?php foreach ($field['options'] as $opt): ?>
                                    <option value="<?= html_escape($opt); ?>"><?= html_escape($opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <input type="text" name="dynamic_field[<?= $field['name']; ?>]" <?= !empty($field['required']) ? 'required' : ''; ?> class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-100 focus:border-indigo-500">
                        <?php endif; ?>
                    </div>
                <?php 
                    endforeach; 
                endif; 
                ?>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition shadow-lg text-sm">
                    Submit Registration
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    $('#regForm').submit(function(e) {
        let valid = true;
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                valid = false;
                $(this).addClass('border-red-500');
            } else {
                $(this).removeClass('border-red-500');
            }
        });
        if (!valid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
});
</script>

</body>
</html>
