<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganizerSeatingController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }


    public function index(Request $request)
    {
        $selectedEventId = $request->query('event_id');

       /*  Tarik daftar semua event aktif milik organizer untuk opsi Dropdown */
        $eventsResponse = Http::withToken(Session::get('api_token'))
                            ->get($this->apiUrl . '/organizer/events');
        $events = $eventsResponse->successful() ? $eventsResponse->json()['data'] ?? [] : [];

        if (!$selectedEventId && count($events) > 0) {
            $selectedEventId = $events[0]['id'];
        }

        $seats = [];
        $stats = ['total_seats' => 0, 'occupied_seats' => 0, 'available_seats' => 0];

        /* Tarik data detail kursi spesifik untuk event_id tersebut */
        if ($selectedEventId) {
            $seatingResponse = Http::withToken(Session::get('api_token'))
                                ->get($this->apiUrl . "/organizer/seating/{$selectedEventId}");

            if ($seatingResponse->successful()) {
                $seats = $seatingResponse->json()['data'] ?? [];
                $stats = $seatingResponse->json()['stats'] ?? $stats;
            }
        }

        return view('organizer.seating', compact('events', 'selectedEventId', 'seats', 'stats'));
    }
}