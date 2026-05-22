<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    // Definisikan URL dasar API 
    protected $apiUrl = 'http://127.0.0.1:8001/api'; 

    /**
     * Menampilkan daftar Event (Mengambil data dari API Mobile)
     */
    public function index()
    {
        // Melakukan HTTP GET Request ke API Mobile
        $response = Http::withToken(Session::get('api_token'))->get($this->apiUrl . '/events');

        // Pastikan request berhasil
        if ($response->successful()) {
            // Mengubah response JSON menjadi array PHP
            $events = $response->json()['data'] ?? [];
        } else {
            $events = []; 
        }

        return view('main_admin.manage_events', compact('events'));
    }

    /**
     * Menampilkan form Buat Event
     */
    public function create()
    {
        return view('main_admin.events');
    }

    /**
     * Memproses data dari Form Web dan Mengirimkannya ke API Mobile
     */
    public function store(Request $request)
    {
        // Validasi inputan form 
        $validated = $request->validate([
            'title' => 'required|string|max=255',
            'event_type' => 'required|string',
            'total_capacity' => 'required|integer',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'venue_name' => 'required|string',
            'venue_address' => 'nullable|string',
        ]);

        $response = Http::withToken(Session::get('api_token'))->post($this->apiUrl . '/events', $validated);

        if ($response->successful()) {
            return redirect('/admin/manage-events')->with('success', 'Event berhasil dibuat via API!');
        } else {
            return back()->withErrors(['api_error' => 'Gagal menyimpan data ke server pusat.'])->withInput();
        }
    }
}