<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganizerCertificateController extends Controller
{
    protected $apiUrl = 'http://127.0.0.1:8001/api';

    public function index(Request $request)
    {
        $selectedEventId = $request->query('event_id');

        /* Tarik daftar event milik Organizer untuk Dropdown */
        $eventsResponse = Http::withToken(Session::get('api_token'))
                            ->get($this->apiUrl . '/organizer/events');
        $events = $eventsResponse->successful() ? $eventsResponse->json()['data'] ?? [] : [];

        if (!$selectedEventId && count($events) > 0) {
            $selectedEventId = $events[0]['id'];
        }

        $participants = [];
        $stats = ['eligible' => 0, 'sent' => 0, 'pending' => 0];

        /* Tarik data peserta yang berhak */
        if ($selectedEventId) {
            $certResponse = Http::withToken(Session::get('api_token'))
                                ->get($this->apiUrl . "/organizer/certificates/{$selectedEventId}");

            if ($certResponse->successful()) {
                $participants = $certResponse->json()['data'] ?? [];
                $stats = $certResponse->json()['stats'] ?? $stats;
            }
        }

        return view('organizer.sertifikat', compact('events', 'selectedEventId', 'participants', 'stats'));
    }


    public function publish(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer'
        ]);

        $response = Http::withToken(Session::get('api_token'))
                        ->post($this->apiUrl . '/organizer/certificates/publish', [
                            'event_id' => $request->event_id
                        ]);

        if ($response->successful()) {
            return back()->with('success', 'E-Sertifikat sedang diproses dan dikirim ke email peserta!');
        }

        return back()->withErrors(['cert_error' => 'Gagal mempublikasikan sertifikat. Pastikan template sudah diatur di API.']);
    }
}