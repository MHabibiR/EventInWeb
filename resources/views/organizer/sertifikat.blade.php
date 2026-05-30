@extends('layout.app')

@section('title', 'E-Sertifikat Event')

@section('content')
    <main class="ml-72 min-h-screen flex bg-slate-50 font-inter">
        
        <div class="w-96 bg-white border-r border-slate-100 flex flex-col shadow-sm sticky top-20 h-[calc(100vh-5rem)] z-30">
            <div class="p-6 border-b bg-slate-50/50">
                <h3 class="font-black text-slate-900 tracking-tight text-lg flex items-center gap-2">
                    <span class="material-symbols-outlined text-cyan-600">workspace_premium</span> Mesin Sertifikat
                </h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Konfigurasi & Distribusi</p>
            </div>
            
            <div class="flex-1 p-6 space-y-8 overflow-y-auto">
                @if(session('success'))
                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-100 flex items-start gap-2 animate-fade-in shadow-sm">
                        <span class="material-symbols-outlined text-emerald-600 text-lg">check_circle</span>
                        <p class="text-xs font-bold text-emerald-800 mt-0.5">{{ session('success') }}</p>
                    </div>
                @endif
                @if($errors->has('cert_error'))
                    <div class="p-3 rounded-xl bg-rose-50 border border-rose-100 flex items-start gap-2 animate-fade-in shadow-sm">
                        <span class="material-symbols-outlined text-rose-600 text-lg">error</span>
                        <p class="text-xs font-bold text-rose-800 mt-0.5">{{ $errors->first('cert_error') }}</p>
                    </div>
                @endif

                <form action="{{ url('/organizer/sertifikat') }}" method="GET" id="event-filter-form" class="m-0">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Pilih Acara Aktif</label>
                    <select name="event_id" onchange="document.getElementById('event-filter-form').submit()" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 cursor-pointer">
                        @foreach($events as $event)
                            <option value="{{ $event['id'] }}" {{ ($selectedEventId ?? '') == $event['id'] ? 'selected' : '' }}>
                                {{ $event['nama_event'] }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Status Distribusi</label>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3.5 bg-slate-50 rounded-xl border border-slate-100 hover:border-slate-300 transition-colors">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Berhak Menerima</span>
                            <span class="text-sm font-black text-slate-900">{{ $stats['eligible'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3.5 bg-emerald-50 rounded-xl border border-emerald-100 hover:border-emerald-200 transition-colors">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Sudah Dikirim</span>
                            <span class="text-sm font-black text-emerald-700">{{ $stats['sent'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3.5 bg-amber-50 rounded-xl border border-amber-100 hover:border-amber-200 transition-colors">
                            <span class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Belum Dikirim</span>
                            <span class="text-sm font-black text-amber-700">{{ $stats['pending'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ url('/organizer/sertifikat/publish') }}" method="POST" class="p-6 border-t bg-slate-50/30 m-0">
                @csrf
                <input type="hidden" name="event_id" value="{{ $selectedEventId ?? '' }}">
                <button type="submit" class="w-full primary-gradient text-white py-4 rounded-2xl font-black text-sm shadow-xl shadow-cyan-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100" {{ ($stats['pending'] ?? 0) == 0 ? 'disabled' : '' }}>
                    <span class="material-symbols-outlined">send</span>
                    Rilis & Kirim Massal
                </button>
                <p class="text-[9px] text-center text-slate-400 font-bold uppercase mt-4 tracking-tighter">
                    Akan dikirim otomatis ke aplikasi mobile peserta
                </p>
            </form>
        </div>

        <div class="flex-1 bg-slate-100 flex flex-col items-center p-12 overflow-y-auto shadow-[inset_0_2px_10px_rgba(0,0,0,0.05)] gap-12">
            
            <div class="flex flex-col items-center gap-6 w-full max-w-4xl">
                <div class="w-full flex justify-between items-center">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                        Preview Desain Sertifikat
                    </h4>
                </div>

                <div class="bg-white w-full aspect-[1.414/1] shadow-2xl relative flex overflow-hidden rounded-md border border-slate-100">
                    <div class="w-40 h-full primary-gradient flex flex-col items-center justify-between py-12 text-white/20">
                        <span class="material-symbols-outlined text-6xl">architecture</span>
                        <div class="rotate-90 origin-center whitespace-nowrap font-black tracking-[1em] text-[10px] uppercase">
                            Tersertifikasi Verifikasi
                        </div>
                        <span class="material-symbols-outlined text-6xl opacity-20">verified_user</span>
                    </div>
                    
                    <div class="flex-1 p-16 flex flex-col justify-between">
                        <div>
                            <div class="text-cyan-700 font-black uppercase tracking-[0.4em] text-[10px] mb-10">Certificate of Attendance</div>
                            <h1 class="text-5xl font-black text-slate-900 mb-4 tracking-tight">Nama Peserta</h1>
                            <p class="text-slate-500 text-lg font-medium leading-relaxed">
                                Telah berpartisipasi dan terverifikasi kehadirannya pada event <br>
                                <span class="text-slate-900 font-bold">EventIn Platform Organizer</span>.
                            </p>
                        </div>

                        <div class="flex items-end justify-between border-t border-slate-100 pt-8">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Date Issued</p>
                                    <p class="font-bold text-slate-900">{{ date('F d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Verification ID</p>
                                    <p class="font-mono text-sm text-cyan-700 font-bold">CERT-{{ date('Y') }}-{{ Str::random(5) }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col items-center gap-2">
                                <div class="w-20 h-20 bg-slate-50 border-2 border-slate-100 rounded-xl flex items-center justify-center p-2 relative group cursor-help">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=VALID-CERT-PREVIEW" alt="Verification QR" class="w-full h-full opacity-80 group-hover:opacity-100 transition-opacity">
                                    <div class="absolute -top-2 -right-2 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center shadow-lg">
                                        <span class="material-symbols-outlined text-[12px] text-white font-bold">check</span>
                                    </div>
                                </div>
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Scan to Verify</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-5xl bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Daftar Penerima Sertifikat</h3>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        Total Peserta: {{ count($participants ?? []) }}
                    </div>
                </div>
                
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-b border-slate-100">
                                <th class="p-6 pl-10">Identitas Peserta</th>
                                <th class="p-6">Waktu Kehadiran</th>
                                <th class="p-6 pr-10 text-right">Status Pengiriman</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($participants as $p)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="p-6 pl-10">
                                        <div class="font-bold text-slate-900">{{ $p['name'] ?? 'Unknown' }}</div>
                                        <div class="text-[10px] text-slate-500 mt-1 font-mono">{{ $p['email'] ?? '-' }}</div>
                                    </td>
                                    <td class="p-6 text-xs text-slate-600 font-medium">
                                        {{ !empty($p['checkin_time']) ? \Carbon\Carbon::parse($p['checkin_time'])->format('d M Y, H:i') : '-' }}
                                    </td>
                                    <td class="p-6 pr-10 text-right">
                                        @if(($p['status'] ?? '') == 'sent')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest shadow-sm">Terkirim</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-slate-100 text-slate-500 text-[10px] font-black rounded-full border border-slate-200 uppercase tracking-widest">Menunggu</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <span class="material-symbols-outlined text-5xl mb-3 opacity-50">description</span>
                                            <p class="text-sm font-bold text-slate-500">Belum ada peserta yang hadir untuk diberikan sertifikat.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        
        <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
        </style>
    </main>
@endsection