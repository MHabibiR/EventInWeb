<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

  
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $response = Http::post($this->apiUrl . '/login-organizer', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

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

            return redirect('/')->withErrors(['login_error' => 'Akses ditolak: Peran pengguna tidak valid.']);
        }

        return back()->withErrors([
            'login_error' => $response->json()['message'] ?? 'Email atau kata sandi salah.'
        ])->withInput();
    }


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