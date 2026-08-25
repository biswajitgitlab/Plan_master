<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function dashboard()
    {
        $events = \App\Models\Event::with(['quotas', 'registrations.user'])->latest()->get();
        return view('admin.dashboard', compact('events'));
    }

    public function index()
    {
        $events = \App\Models\Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'form_schema' => 'nullable|json',
            'quotas' => 'nullable|array',
            'approval_bands' => 'nullable|array',
        ]);

        $validated['created_by'] = auth()->id();
        
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('events', 'public');
        }

        if (!empty($validated['form_schema'])) {
            $validated['form_schema'] = json_decode($validated['form_schema'], true);
        }

        $event = \App\Models\Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
            'created_by' => $validated['created_by'],
            'form_schema' => $validated['form_schema'] ?? null,
        ]);

        // Process Quotas
        if (!empty($request->quotas) && is_array($request->quotas)) {
            foreach ($request->quotas as $role => $limit) {
                if ($limit !== null && $limit !== '' && intval($limit) > 0) {
                    $event->quotas()->create([
                        'role_name' => ucfirst($role),
                        'quota_limit' => intval($limit),
                    ]);
                }
            }
        }

        // Process Approval Bands
        if (!empty($request->approval_bands) && is_array($request->approval_bands)) {
            $seq = 1;
            foreach ($request->approval_bands as $role) {
                if (!empty($role)) {
                    $event->approvalBands()->create([
                        'role_name' => $role,
                        'level_sequence' => $seq++,
                    ]);
                }
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(\App\Models\Event $event)
    {
        $event->load(['quotas', 'approvalBands']);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, \App\Models\Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'form_schema' => 'nullable|json',
        ]);
        
        if ($request->hasFile('image')) {
            if ($event->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($event->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('events', 'public');
        }

        if (!empty($validated['form_schema'])) {
            $validated['form_schema'] = json_decode($validated['form_schema'], true);
        } else {
            $validated['form_schema'] = null;
        }

        $event->update($validated);

        return redirect()->route('admin.events.edit', $event)->with('success', 'Event updated successfully.');
    }

    public function destroy(\App\Models\Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    // Quotas
    public function storeQuota(Request $request, \App\Models\Event $event)
    {
        $validated = $request->validate([
            'role_name' => 'required|string|max:255',
            'quota_limit' => 'required|integer|min:1',
        ]);

        $event->quotas()->create($validated);
        return back()->with('success', 'Quota added successfully.');
    }

    public function destroyQuota(\App\Models\EventQuota $quota)
    {
        $quota->delete();
        return back()->with('success', 'Quota removed.');
    }

    // Approval Bands
    public function storeApprovalBand(Request $request, \App\Models\Event $event)
    {
        $validated = $request->validate([
            'role_name' => 'required|string|max:255',
            'level_sequence' => 'required|integer|min:1',
        ]);

        $event->approvalBands()->create($validated);
        return back()->with('success', 'Approval band added successfully.');
    }

    public function destroyApprovalBand(\App\Models\ApprovalBand $approvalBand)
    {
        $approvalBand->delete();
        return back()->with('success', 'Approval band removed.');
    }
}
