<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Make a mock payment for a booking
    public function store(Request $request, Booking $booking)
    {
         $payment = $booking->payment()->create([
            'amount' => $booking->ticket->price * $booking->quantity,
            'status' => $isSuccessful ? 'paid' : 'failed',
        ]);

          return $payment;
    }


     public function isSuccessful(Payment $payment): bool
    {
        return $payment->status === 'paid';
    }
    // View a payment
    public function show(Payment $payment)
    {
        return response()->json($payment);
    }
}
