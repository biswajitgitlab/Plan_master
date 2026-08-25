<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Event::latest();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }

    $events = $query->paginate(6);
    return view('welcome', compact('events'));
});

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Event::latest();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }

    $events = $query->paginate(6);
    return view('dashboard', compact('events'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Public Event Registration Routes
    Route::get('/events', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [\App\Http\Controllers\RegistrationController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('events.register');

    // Sub-Admin / Approver Routes
    Route::middleware(['is_approver'])->group(function () {
        Route::get('/approvals', [\App\Http\Controllers\RegistrationApprovalController::class, 'index'])->name('approvals.index');
        Route::post('/approvals/{registration}/approve', [\App\Http\Controllers\RegistrationApprovalController::class, 'approve'])->name('approvals.approve');
        Route::post('/approvals/{registration}/reject', [\App\Http\Controllers\RegistrationApprovalController::class, 'reject'])->name('approvals.reject');
    });
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\EventController::class, 'dashboard'])->name('dashboard');
    Route::resource('events', \App\Http\Controllers\EventController::class);
    
    // Quotas
    Route::post('events/{event}/quotas', [\App\Http\Controllers\EventController::class, 'storeQuota'])->name('events.quotas.store');
    Route::delete('quotas/{quota}', [\App\Http\Controllers\EventController::class, 'destroyQuota'])->name('quotas.destroy');
    
    // Approval Bands
    Route::post('events/{event}/approval-bands', [\App\Http\Controllers\EventController::class, 'storeApprovalBand'])->name('events.approval-bands.store');
    Route::delete('approval-bands/{approvalBand}', [\App\Http\Controllers\EventController::class, 'destroyApprovalBand'])->name('approval-bands.destroy');
});
