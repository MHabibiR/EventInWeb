<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Menangani permintaan yang masuk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('api_token')) {
            return redirect('/')
                ->withErrors(['login_error' => 'Sesi Anda telah habis atau Anda belum login. Silakan masuk terlebih dahulu.']);
        }

        return $next($request);
    }
}