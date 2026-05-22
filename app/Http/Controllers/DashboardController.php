<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $apiUrl = 'http://127.0.0.1:8001/api';


    public function adminIndex()
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/admin/dashboard-stats');

        if ($response->successful()) {
            $stats = $response->json()['data'] ?? [
                'total_events' => 0,
                'total_organizers' => 0,
                'total_participants' => 0,
                'pending_proposals' => 0,
                'recent_events' => []
            ];
        } else {
            $stats = [
                'total_events' => 0,
                'total_organizers' => 0,
                'total_participants' => 0,
                'pending_proposals' => 0,
                'recent_events' => []
            ];
        }
        
        return view('main_admin.dashboard', compact('stats'));
    }
}