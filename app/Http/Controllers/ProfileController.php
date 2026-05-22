<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    protected $apiUrl = 'http://127.0.0.1:8001/api';

    public function index()
    {
        /* Mengambil data profil terbaru  */
        $response = Http::withToken(Session::get('api_token'))
                        ->get($this->apiUrl . '/user/profile');

        if ($response->successful()) {
            $user = $response->json()['data'];
        } else {
            $user = Session::get('user_data');
        }

        return view('profile', compact('user'));
    }


    public function update(Request $request)
    {
        /* Validasi input form web */
        $rules = [
            'name' => 'required|string|max=255',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ];

        /* Tambahan validasi khusus jika yang login adalah organizer */
        if (Session::get('user_data.role') === 'organizer') {
            $rules['organization_type'] = 'nullable|string';
            $rules['phone'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        /* Kirim data pembaruan ke API  */
        $response = Http::withToken(Session::get('api_token'))
                        ->put($this->apiUrl . '/user/profile/update', $validated);

        if ($response->successful()) {
            $newData = $response->json()['data'];
            Session::put('user_data', $newData);

            return back()->with('success', 'Profil Anda berhasil diperbarui!');
        }

        return back()->withErrors(['api_error' => 'Gagal memperbarui data profil ke server.'])->withInput();
    }
}