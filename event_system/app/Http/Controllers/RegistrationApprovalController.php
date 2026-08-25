<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationApprovalController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $userRoles = $user->getRoleNames()->toArray();
        $statusFilter = $request->input('status', 'pending');
        
        if (empty($userRoles)) {
            $registrations = collect();
            return view('approvals.index', compact('registrations'));
        }

        $query = \App\Models\Registration::with(['event', 'user', 'approvals.approver']);

        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        if (!$user->hasRole('Admin')) {
            $query->whereHas('event.approvalBands', function($q) use ($userRoles) {
                $q->whereIn('role_name', $userRoles)
                  ->whereColumn('level_sequence', 'registrations.current_approval_level');
            });
        }

        $registrations = $query->latest()->paginate(10);

        return view('approvals.index', compact('registrations'));
    }

    public function approve(Request $request, \App\Models\Registration $registration)
    {
        $user = auth()->user();

        // Log the approval
        \App\Models\RegistrationApproval::create([
            'registration_id' => $registration->id,
            'approver_id' => $user->id,
            'status' => 'approved',
            'comments' => $request->input('comments', ''),
        ]);

        // Check if there are more approval levels
        $nextBand = \App\Models\ApprovalBand::where('event_id', $registration->event_id)
            ->where('level_sequence', '>', $registration->current_approval_level)
            ->orderBy('level_sequence', 'asc')
            ->first();

        if ($nextBand) {
            $registration->current_approval_level = $nextBand->level_sequence;
            $registration->save();
            $this->notifyApprovers($registration);
        } else {
            $registration->status = 'approved';
            $registration->save();
            $registration->user->notify(new \App\Notifications\RegistrationStatusUpdated($registration, 'Your registration has been fully approved!'));
        }

        return back()->with('success', 'Registration approved successfully.');
    }

    public function reject(Request $request, \App\Models\Registration $registration)
    {
        $user = auth()->user();

        // Log the rejection
        \App\Models\RegistrationApproval::create([
            'registration_id' => $registration->id,
            'approver_id' => $user->id,
            'status' => 'rejected',
            'comments' => $request->input('comments', ''),
        ]);

        $registration->status = 'rejected';
        $registration->save();
        $registration->user->notify(new \App\Notifications\RegistrationStatusUpdated($registration, 'Unfortunately, your registration has been rejected.'));

        // Optional: Waitlist Promotion
        $rejectedUserRole = $registration->user->getRoleNames()->first() ?? 'User';

        $waitlistedRegistration = \App\Models\Registration::where('event_id', $registration->event_id)
            ->where('status', 'waitlisted')
            ->whereHas('user', function ($q) use ($rejectedUserRole) {
                $q->role($rejectedUserRole);
            })
            ->orderBy('created_at', 'asc')
            ->first();

        if ($waitlistedRegistration) {
            $waitlistedRegistration->status = 'pending';
            $waitlistedRegistration->current_approval_level = 1;
            $waitlistedRegistration->save();
            
            $waitlistedRegistration->user->notify(new \App\Notifications\RegistrationStatusUpdated($waitlistedRegistration, 'A spot has opened up! Your registration is now pending approval.'));
            $this->notifyApprovers($waitlistedRegistration);
        }

        return back()->with('success', 'Registration rejected. (Waitlist processed if applicable).');
    }

    protected function notifyApprovers(\App\Models\Registration $registration)
    {
        $band = \App\Models\ApprovalBand::where('event_id', $registration->event_id)
            ->where('level_sequence', $registration->current_approval_level)
            ->first();

        if ($band) {
            $approvers = \App\Models\User::role($band->role_name)->get();
            \Illuminate\Support\Facades\Notification::send($approvers, new \App\Notifications\RegistrationRequiresApproval($registration));
        }
    }
}
