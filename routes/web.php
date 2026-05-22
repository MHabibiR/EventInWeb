<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckApiToken;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* auth */
Route::get('/', function () {
    return view('auth.login'); 
});
Route::get('/lupa_password', function () {
    return view('auth.lupa_password'); 
});
Route::get('/reset_password', function () {
    return view('auth.reset_password'); 
});
Route::post('/login-process', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/* admin */
Route::prefix('admin')
    ->middleware(CheckApiToken::class)
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('main_admin.dashboard'); 
        });
        Route::get('/events', function () {
            return view('main_admin.events');
        });
        Route::get('/manage_events', function () {
            return view('main_admin.manage_events'); 
        });
        Route::get('/manage_organizer', function () {
            return view('main_admin.manage_organizer');
        });
        Route::get('/proposals', function () {
            return view('main_admin.proposals'); 
        });
        Route::get('/manage-events', [EventController::class, 'index']);
        Route::get('/events/create', [EventController::class, 'create']);
        Route::post('/events/store', [EventController::class, 'store']);
});

/* organizer */
Route::prefix('organizer')
    ->middleware(CheckApiToken::class)
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('organizer.dashboard'); 
        });
        Route::get('/peserta', function () {
            return view('organizer.peserta'); 
        });
        Route::get('/checkin', function () {
            return view('organizer.checkin');
        });
        Route::get('/seating', function () {
            return view('organizer.seating'); 
        });
        Route::get('/lucky_draw', function () {
            return view('organizer.lucky_draw');
        });
        Route::get('/sertifikat', function () {
            return view('organizer.sertifikat'); 
        });
});