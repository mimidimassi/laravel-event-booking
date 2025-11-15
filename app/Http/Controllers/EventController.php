<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    //

  public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * GET /api/events
     * List events with pagination, search by title, filter by date/location
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Paginate (default 10 per page)
        $events = $query->latest()->paginate($request->get('per_page', 10));

        return response()->json($events);
    }

    /**
     * GET /api/events/{id}
     * Show a single event with tickets
     */
    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        return response()->json($event);
    }

    /**
     * POST /api/events
     * Create event (organizer only)
     */
    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'organizer') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event = $user->events()->create($request->all());

        return response()->json($event, 201);
    }

    /**
     * PUT /api/events/{id}
     * Update event (organizer only)
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();

        if ($user->role !== 'organizer') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event = $user->events()->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'date' => 'sometimes|date',
            'location' => 'sometimes|string|max:255',
        ]);

        $event->update($request->all());

        return response()->json($event);
    }

    /**
     * DELETE /api/events/{id}
     * Delete event (organizer only)
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        if ($user->role !== 'organizer') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event = $user->events()->findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }


}
