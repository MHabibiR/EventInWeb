<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminOrganizerController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }


    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/admin/organizers');

        if ($response->successful()) {
            $organizers = $response->json()['data'] ?? [];
            $stats = $response->json()['stats'] ?? ['pending' => 0, 'total' => 0];
        } else {
            $organizers = [];
            $stats = ['pending' => 0, 'total' => 0];
        }

        return view('main_admin.manage_organizer', compact('organizers', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('action'); 

        $response = Http::withToken(Session::get('api_token'))
                        ->post($this->apiUrl . "/admin/organizers/{$id}/status", [
                            'status' => $status
                        ]);

        if ($response->successful()) {
            return back()->with('success', 'Status Organizer berhasil diperbarui!');
        }

        return back()->withErrors(['api_error' => 'Gagal memperbarui status.']);
    }
}