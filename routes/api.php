<?php


use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//route test 
Route::get('/testfromapi', function () {
    return 'API is working';
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



// Event Routes
Route::middleware(['auth:sanctum', 'role:admin,organizer'])->group(function () {
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
});

// Ticket Routes
Route::middleware(['auth:sanctum', 'role:admin,organizer'])->group(function () {
    Route::post('/events/{event}/tickets', [TicketController::class, 'store']);
    Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
});

// Booking Routes
Route::middleware(['auth:sanctum', 'role:customer,admin'])->group(function () {
    Route::post('/tickets/{ticket}/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::put('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);
});

// Payment Routes
Route::middleware(['auth:sanctum', 'role:customer,admin'])->group(function () {
    Route::post('/bookings/{booking}/payment', [PaymentController::class, 'store']);
    Route::get('/payments/{payment}', [PaymentController::class, 'show']);
});