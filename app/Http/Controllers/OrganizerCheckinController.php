<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganizerCheckinController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/organizer/checkin-history');

        if ($response->successful()) {
            $history = $response->json()['data'] ?? [];
            $stats = $response->json()['stats'] ?? ['total_checked_in' => 0, 'remaining' => 0];
        } else {
            $history = [];
            $stats = ['total_checked_in' => 0, 'remaining' => 0];
        }

        return view('organizer.checkin', compact('history', 'stats'));
    }


    public function verify(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string'
        ]);

        /* Menembak API untuk memvalidasi tiket */
        $response = Http::withToken(Session::get('api_token'))
                        ->post($this->apiUrl . '/organizer/checkin/verify', [
                            'kode_transaksi' => $request->booking_code
                        ]);

        if ($response->successful()) {
            $data = $response->json();
            return back()->with('success', "Tiket Valid! Peserta atas nama {$data['participant_name']} berhasil Check-In.");
        } else {
            $errorMessage = $response->json()['message'] ?? 'Kode tiket tidak valid atau sudah digunakan.';
            return back()->withErrors(['checkin_error' => $errorMessage])->withInput();
        }
    }
}