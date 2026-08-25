<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $events = \App\Models\Event::whereDate('end_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->paginate(10);
            
        return view('events.index', compact('events'));
    }

    public function show(\App\Models\Event $event)
    {
        $user = auth()->user();
        $registration = \App\Models\Registration::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->first();

        return view('events.show', compact('event', 'registration'));
    }

    public function store(Request $request, \App\Models\Event $event)
    {
        $user = auth()->user();
        
        // Prevent duplicate registration
        if (\App\Models\Registration::where('event_id', $event->id)->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You are already registered for this event.');
        }

        $request->validate([
            'form_data' => [new \App\Rules\ValidDynamicForm($event->form_schema)],
        ]);

        // Determine user role (Using Spatie, fallback to 'User')
        $userRoleName = $user->getRoleNames()->first() ?? 'User';

        // Quota check logic
        $quota = $event->quotas()->where('role_name', $userRoleName)->first();
        
        $status = 'pending';
        
        if ($quota) {
            // Check how many people with THIS role are already registered (pending or approved, not rejected)
            // Wait, we don't store the user's role in registration, so we must join with users/model_has_roles, OR
            // just count total registrations if quota is general?
            // Actually, for simplicity and typical implementation, we might just check if event has space for this role.
            // Let's count registrations of users who have this role.
            $currentCount = \App\Models\Registration::where('event_id', $event->id)
                ->where('status', '!=', 'rejected')
                ->whereHas('user', function ($q) use ($userRoleName) {
                    $q->role($userRoleName);
                })
                ->count();

            if ($currentCount >= $quota->quota_limit) {
                $status = 'waitlisted';
            }
        } else {
            // If no specific quota is defined for this role, we might consider a general limit, 
            // but the requirements say "checks their role against the event_quotas table".
            // If no quota exists for their role, we can just allow them as pending.
            $status = 'pending';
        }

        $registration = \App\Models\Registration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => $status,
            'form_data' => $request->input('form_data', []),
            'current_approval_level' => 1,
        ]);

        if ($status === 'pending') {
            $band = \App\Models\ApprovalBand::where('event_id', $event->id)
                ->where('level_sequence', 1)
                ->first();

            if ($band) {
                $approvers = \App\Models\User::role($band->role_name)->get();
                \Illuminate\Support\Facades\Notification::send($approvers, new \App\Notifications\RegistrationRequiresApproval($registration));
            }
        }

        $message = $status === 'waitlisted' 
            ? 'Registration successful, but you have been placed on the waitlist as the quota is full.' 
            : 'Registration submitted successfully and is pending approval.';

        return back()->with('success', $message);
    }
}
