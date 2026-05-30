<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {
        // Panggil API untuk mendapatkan profil (contoh endpoint: GET /api/profile)
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/profile');
        
        $profile = [];
        if ($response->successful()) {
            $profile = $response->json()['data'] ?? [];
        }

        return view('profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_handphone' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            // Tambahkan validasi password jika ada field ubah password
        ]);

        // Panggil API untuk update profil (contoh endpoint: PUT /api/profile/edit-profile)
        $response = Http::withToken(Session::get('api_token'))
                        ->put($this->apiUrl . '/profile/edit-profile', $validated);

        if ($response->successful()) {
            $newData = $response->json()['data'];
            Session::put('user_data', $newData);

            return back()->with('success', 'Profil Anda berhasil diperbarui!');
        }

        return back()->withErrors(['api_error' => 'Gagal memperbarui data profil ke server.'])->withInput();
    }
}