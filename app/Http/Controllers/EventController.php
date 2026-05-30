<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))->get($this->apiUrl . '/admin/events');

        if ($response->successful()) {
            $events = $response->json()['data'] ?? [];
        } else {
            $events = []; 
        }

        return view('main_admin.manage_events', compact('events'));
    }

    public function create()
    {
        return view('main_admin.events');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event'   => 'required|string|max:255',
            'deskripsi'    => 'required',
            'tanggal'      => 'required|date',
            'gambar_event' => 'required|image|mimes:jpeg,png,jpg|max:2048' 
        ], [
            'nama_event.required' => 'Nama event wajib diisi!',
            'gambar_event.image' => 'File harus berupa gambar!'
        ]);


        $apiCall = Http::withToken(Session::get('api_token'));

        if ($request->hasFile('gambar_event')) {
            $file = $request->file('gambar_event');
            
            $apiCall->attach(
                'gambar_event', 
                file_get_contents($file->getRealPath()), 
                $file->getClientOriginalName()
            );
        }

        $response = $apiCall->post($this->apiUrl . '/admin/events', [
            'nama_event' => $request->input('nama_event'),
            'deskripsi'  => $request->input('deskripsi'),
            'tanggal'    => $request->input('tanggal'),
        ]);

        if ($response->successful()) {
            return redirect('/admin/manage-events')->with('success', 'Event berhasil ditambahkan!');
        }

        if ($response->status() === 422) {
            return back()->withErrors($response->json()['errors'])->withInput();
        }

        return back()->withErrors(['api_error' => 'Gagal menyimpan data ke server API.'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_event' => 'required|string',
            'gambar_event' => 'nullable|image|max:2048' 
        ]);

        $apiCall = Http::withToken(Session::get('api_token'));

        if ($request->hasFile('gambar_event')) {
            $file = $request->file('gambar_event');
            $apiCall->attach(
                'gambar_event', 
                file_get_contents($file->getRealPath()), 
                $file->getClientOriginalName()
            );
        }

        $response = $apiCall->post($this->apiUrl . "/admin/events/{$id}", [
            '_method' => 'PUT', 
            'nama_event' => $request->input('nama_event'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if ($response->successful()) {
            return redirect('/admin/manage-events')->with('success', 'Data Event berhasil diperbarui!');
        }

        if ($response->status() === 422) {
            return back()->withErrors($response->json()['errors'])->withInput();
        }

        return back()->withErrors(['api_error' => 'Gagal memperbarui data di server.']);
    }


    public function destroy($id)
    {
        $response = Http::withToken(Session::get('api_token'))
                        ->delete($this->apiUrl . "/admin/events/{$id}");

        if ($response->successful()) {
            return redirect('/admin/manage-events')->with('success', 'Event berhasil dihapus!');
        }
        
        if ($response->status() === 404) {
            return back()->withErrors(['api_error' => 'Event tidak ditemukan di server.']);
        }

        return back()->withErrors(['api_error' => 'Gagal menghapus event. Terjadi kesalahan pada server.']);
    }
}