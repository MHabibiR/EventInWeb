<?php

use Illuminate\Support\Facades\Route;
/* auth */
use App\Http\Middleware\CheckApiToken;
use App\Http\Controllers\AuthController;

/* admin */
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminOrganizerController;
use App\Http\Controllers\AdminProposalController;

/* organizer */
use App\Http\Controllers\OrganizerDashboardController;
use App\Http\Controllers\OrganizerParticipantController;
use App\Http\Controllers\OrganizerCheckinController;
use App\Http\Controllers\OrganizerSeatingController;
use App\Http\Controllers\OrganizerLuckyDrawController;
use App\Http\Controllers\OrganizerCertificateController;

use App\Http\Controllers\ProfileController;

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
        Route::get('/dashboard', [DashboardController::class, 'adminIndex']);
        Route::get('/manage-events', [EventController::class, 'index']);
        Route::get('/events/create', [EventController::class, 'create']);
        Route::post('/events/store', [EventController::class, 'store']);
        Route::get('/manage_organizer', [AdminOrganizerController::class, 'index']);
        Route::post('/manage_organizer/{id}/status', [AdminOrganizerController::class, 'updateStatus']);
        Route::get('/proposals', [AdminProposalController::class, 'index']);
        Route::post('/proposals/{id}/status', [AdminProposalController::class, 'updateStatus']);
});

/* organizer */
Route::prefix('organizer')
    ->middleware(CheckApiToken::class)
    ->group(function () {
        Route::get('/dashboard', [OrganizerDashboardController::class, 'index']);
        Route::get('/peserta', [OrganizerParticipantController::class, 'index']);
        Route::get('/checkin', [OrganizerCheckinController::class, 'index']);
        Route::post('/checkin/verify', [OrganizerCheckinController::class, 'verify']);
        Route::get('/seating', [OrganizerSeatingController::class, 'index']); 
        Route::get('/lucky_draw', [OrganizerLuckyDrawController::class, 'index']); 
        Route::post('/lucky_draw/winner', [OrganizerLuckyDrawController::class, 'storeWinner']);
        Route::get('/sertifikat', [OrganizerCertificateController::class, 'index']); 
        Route::post('/sertifikat/publish', [OrganizerCertificateController::class, 'publish']);
});

/* Profile */
Route::middleware(CheckApiToken::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
});