<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminProposalController extends Controller
{
    protected $apiUrl = 'http://127.0.0.1:8001/api';

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/admin/proposals');

        if ($response->successful()) {
            $proposals = $response->json()['data'] ?? [];
            $stats = $response->json()['stats'] ?? ['pending' => 0, 'approved' => 0, 'rejected' => 0];
        } else {
            $proposals = [];
            $stats = ['pending' => 0, 'approved' => 0, 'rejected' => 0];
        }

        return view('main_admin.proposals', compact('proposals', 'stats'));
    }


    public function updateStatus(Request $request, $id)
    {
        $action = $request->input('action'); 

        $response = Http::withToken(Session::get('api_token'))
                        ->post($this->apiUrl . "/admin/proposals/{$id}/status", [
                            'status' => $action
                        ]);

        if ($response->successful()) {
            return back()->with('success', 'Status proposal berhasil diperbarui!');
        }

        return back()->withErrors(['api_error' => 'Gagal memperbarui status proposal.']);
    }
}