<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Booking;
use App\Notifications\BookingConfirmed;
class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Book a ticket (Customer)
    public function store(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $ticket->quantity,
        ]);

        $booking = $ticket->bookings()->create([
            'user_id' => $request->user()->id,
            'quantity' => $validated['quantity'],
            'status' => 'booked',
        ]);
 // Notify customer
    $request->user()->notify(new BookingConfirmed($booking));
    
        return response()->json($booking, 201);
    }

    // Get current user's bookings
    public function index(Request $request)
    {
        $user = $request->user();

        $bookings = Booking::with('ticket.event')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($bookings);
    }

    // Cancel a booking
    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'canceled']);

        return response()->json(['message' => 'Booking canceled successfully']);
    }
}
