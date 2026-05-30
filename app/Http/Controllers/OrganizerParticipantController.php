<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganizerParticipantController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/organizer/participants');

        if ($response->successful()) {
            $participants = $response->json()['data'] ?? [];
            $stats = $response->json()['stats'] ?? [
                'total_participants' => 0,
                'paid_participants' => 0,
                'pending_participants' => 0
            ];
        } else {
            $participants = [];
            $stats = [
                'total_participants' => 0,
                'paid_participants' => 0,
                'pending_participants' => 0
            ];
        }

        return view('organizer.peserta', compact('participants', 'stats'));
    }
}