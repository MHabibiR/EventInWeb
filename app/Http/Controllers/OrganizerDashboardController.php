<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganizerDashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/organizer/dashboard');

        if ($response->successful()) {
            $stats = $response->json()['data'] ?? [
                'active_events' => 0,
                'total_participants' => 0,
                'total_revenue' => 0,
                'recent_registrations' => []
            ];
        } else {
            $stats = [
                'active_events' => 0,
                'total_participants' => 0,
                'total_revenue' => 0,
                'recent_registrations' => []
            ];
        }

        return view('organizer.dashboard', compact('stats'));
    }
}