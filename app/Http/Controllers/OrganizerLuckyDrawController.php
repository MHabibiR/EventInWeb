<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganizerLuckyDrawController extends Controller
{
    protected $apiUrl = 'http://127.0.0.1:8001/api';

    public function index(Request $request)
    {
        $selectedEventId = $request->query('event_id');

        /* Ambil daftar event milik Organizer */
        $eventsResponse = Http::withToken(Session::get('api_token'))
                            ->get($this->apiUrl . '/organizer/events');
        $events = $eventsResponse->successful() ? $eventsResponse->json()['data'] ?? [] : [];

        if (!$selectedEventId && count($events) > 0) {
            $selectedEventId = $events[0]['id'];
        }

        $participants = [];
        $winners = [];

        /* Ambil peserta yang SUDAH CHECK-IN dan riwayat pemenang */
        if ($selectedEventId) {
            $drawResponse = Http::withToken(Session::get('api_token'))
                                ->get($this->apiUrl . "/organizer/lucky-draw/{$selectedEventId}");

            if ($drawResponse->successful()) {
                $participants = $drawResponse->json()['eligible_participants'] ?? [];
                $winners = $drawResponse->json()['winners'] ?? [];
            }
        }

        return view('organizer.lucky_draw', compact('events', 'selectedEventId', 'participants', 'winners'));
    }

    /* Menyimpan pemenang lucky draw */
    public function storeWinner(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer',
            'participant_id' => 'required|integer',
        ]);

        $response = Http::withToken(Session::get('api_token'))
                        ->post($this->apiUrl . '/organizer/lucky-draw/winner', [
                            'event_id' => $request->event_id,
                            'participant_id' => $request->participant_id
                        ]);

        if ($response->successful()) {
            return back()->with('success', 'Pemenang undian berhasil disimpan!');
        }

        return back()->withErrors(['draw_error' => 'Gagal menyimpan data pemenang.']);
    }
}