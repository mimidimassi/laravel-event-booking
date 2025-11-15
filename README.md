# Laravel Event Booking

A simple **Laravel 12** project for managing events, tickets, bookings, and payments.

---

## Features

- User roles: Admin, Organizer, Customer  
- Admin: Manage all events, tickets, bookings  
- Organizer: Manage their own events/tickets  
- Customer: Book tickets and view bookings  
- Event filtering by date/location  
- Mock payment system with notifications via queue  

---

## Installation

```bash
git clone https://github.com/mimidimassi/laravel-event-booking.git
cd laravel-event-booking
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
