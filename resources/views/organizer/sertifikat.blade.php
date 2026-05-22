@extends('layout.app')

@section('title', 'E-Sertifikat Event')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Distribusi E-Sertifikat</h2>
                    <p class="text-slate-500 mt-2 font-medium">Kelola dan kirim sertifikat digital kepada peserta yang telah hadir.</p>
                </div>
                
                <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-sm min-w-[280px]">
                    <form action="{{ url('/organizer/sertifikat') }}" method="GET" id="event-filter-form">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 pl-1">Pilih Acara</label>
                        <select name="event_id" onchange="document.getElementById('event-filter-form').submit()" class="w-full bg-transparent font-bold text-slate-800 focus:outline-none text-sm cursor-pointer">
                            @foreach($events as $event)
                                <option value="{{ $event['id'] }}" {{ $selectedEventId == $event['id'] ? 'selected' : '' }}>
                                    {{ $event['title'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->has('cert_error'))
                <div class="mb-8 p-4 rounded-xl bg-rose-50 border border-rose-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                    <p class="text-sm font-bold text-rose-700">{{ $errors->first('cert_error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-12 gap-8">
                
                <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
                    
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <div class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-3xl">workspace_premium</span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">Sertifikat Peserta</h3>
                        <p class="text-sm text-slate-500 mb-8">Sistem hanya akan menerbitkan sertifikat untuk peserta dengan status kehadiran valid.</p>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Berhak Menerima</span>
                                <span class="text-lg font-black text-slate-900">{{ $stats['eligible'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Sudah Dikirim</span>
                                <span class="text-lg font-black text-emerald-700">{{ $stats['sent'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-amber-50 rounded-xl border border-amber-100">
                                <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Belum Dikirim</span>
                                <span class="text-lg font-black text-amber-700">{{ $stats['pending'] ?? 0 }}</span>
                            </div>
                        </div>

                        <form action="{{ url('/organizer/sertifikat/publish') }}" method="POST">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $selectedEventId }}">
                            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-4 px-4 rounded-xl transition-colors shadow-lg shadow-cyan-600/30 uppercase tracking-widest text-sm flex items-center justify-center gap-2" {{ ($stats['pending'] ?? 0) == 0 ? 'disabled' : '' }}>
                                <span class="material-symbols-outlined">send</span>
                                Rilis & Kirim Massal
                            </button>
                        </form>
                    </div>

                </div>

                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden h-full flex flex-col">
                        <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Daftar Penerima Sertifikat</h3>
                        </div>
                        
                        <div class="overflow-x-auto flex-1">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-white text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-b border-slate-100">
                                        <th class="p-6 pl-8">Peserta</th>
                                        <th class="p-6">Waktu Kehadiran</th>
                                        <th class="p-6 pr-8 text-right">Status Pengiriman</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-100">
                                    @forelse($participants as $p)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="p-6 pl-8">
                                                <div class="font-bold text-slate-900">{{ $p['name'] }}</div>
                                                <div class="text-[10px] text-slate-500 mt-1 font-mono">{{ $p['email'] }}</div>
                                            </td>
                                            <td class="p-6 text-xs text-slate-600 font-medium">
                                                {{ $p['checkin_time'] ? \Carbon\Carbon::parse($p['checkin_time'])->format('d M Y, H:i') : '-' }}
                                            </td>
                                            <td class="p-6 pr-8 text-right">
                                                @if($p['status'] == 'sent')
                                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Terkirim</span>
                                                @else
                                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-full border border-slate-200 uppercase tracking-widest">Menunggu</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="p-12 text-center text-slate-400">
                                                <span class="material-symbols-outlined text-4xl mb-2 opacity-50">description</span>
                                                <p class="text-xs font-bold uppercase tracking-widest">Belum ada peserta yang hadir</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
    </style>
@endsection