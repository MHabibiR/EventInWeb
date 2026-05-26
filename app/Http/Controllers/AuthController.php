<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Sesuaikan URL ini dengan port API lokal teman Anda
    protected $apiUrl = 'http://127.0.0.1:8001/api'; 

    /**
     * Memproses permintaan login dari form web
     */
    public function login(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Tembak API untuk verifikasi kredensial
        $response = Http::post($this->apiUrl . '/login-organizer', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        /* dd($response->status(), $response->json()); */

        // 3. Jika API mengembalikan status sukses (biasanya 200 OK)
        if ($response->successful()) {
            $data = $response->json();

            Session::put('api_token', $data['token']);
            Session::put('user_data', $data['data']);

            if (($data['data']['role'] ?? null) == 'main_admin') {
                return redirect('/admin/dashboard');
            }

            if (($data['data']['role'] ?? null) == 'organizer') {
                return redirect('/organizer/dashboard');
            }

            // Fallback jika role tidak dikenali
            return redirect('/')->withErrors(['login_error' => 'Akses ditolak: Peran pengguna tidak valid.']);
        }

        // Jika API menolak (kredensial salah atau user tidak ada)
        return back()->withErrors([
            'login_error' => $response->json()['message'] ?? 'Email atau kata sandi salah.'
        ])->withInput();
    }

    /**
     * Memproses logout
     */
    public function logout()
    {
        $token = Session::get('api_token');
        if ($token) {
            Http::withToken($token)->post($this->apiUrl . '/logout');
        }

        Session::flush();
        
        return redirect('/');
    }
}