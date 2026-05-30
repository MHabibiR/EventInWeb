<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('api_token')) {
            Session::flush(); 
            return redirect('/')->withErrors([
                'login_error' => 'Sesi Anda telah habis atau Anda belum login. Silakan login kembali.'
            ]);
        }

        $userData = Session::get('user_data');
        $role = $userData['role'] ?? null;

        if ($request->is('admin') || $request->is('admin/*')) {
            if ($role !== 'main_admin') {
                return redirect('/')->withErrors([
                    'login_error' => 'Akses ditolak: Anda bukan Main Admin.'
                ]);
            }
        }

        if ($request->is('organizer') || $request->is('organizer/*')) {
            if ($role !== 'organizer') {
                return redirect('/')->withErrors([
                    'login_error' => 'Akses ditolak: Anda bukan Organizer.'
                ]);
            }
        }

        return $next($request);
    }
}