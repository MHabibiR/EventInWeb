@extends('layout.app')

@section('title', 'Gate Check-In')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50 font-inter">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Gate Control & Monitoring</h2>
                    <p class="text-slate-500 mt-2 font-medium">Validasi kehadiran masuk/keluar peserta dan pantau kuota acara secara real-time.</p>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm text-center min-w-[160px]">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Hadir Saat Ini</p>
                        <p class="text-3xl font-black text-cyan-600">
                            {{ $stats['total_checked_in'] ?? 0 }} 
                            <span class="text-xs text-slate-300 font-bold">/ {{ ($stats['total_checked_in'] ?? 0) + ($stats['remaining'] ?? 0) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-5 space-y-6">
                    
                    <div class="bg-slate-900 rounded-[2.5rem] aspect-square relative overflow-hidden shadow-2xl border-8 border-white">
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white/10">
                            <span class="material-symbols-outlined text-9xl animate-pulse">qr_code_scanner</span>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] mt-4">Kamera Siap Memindai...</p>
                        </div>
                        
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-64 h-64 border-2 border-cyan-400 rounded-3xl relative">
                                <div class="absolute -top-1 -left-1 w-8 h-8 border-t-4 border-l-4 border-cyan-400 rounded-tl-lg"></div>
                                <div class="absolute -top-1 -right-1 w-8 h-8 border-t-4 border-r-4 border-cyan-400 rounded-tr-lg"></div>
                                <div class="absolute -bottom-1 -left-1 w-8 h-8 border-b-4 border-l-4 border-cyan-400 rounded-bl-lg"></div>
                                <div class="absolute -bottom-1 -right-1 w-8 h-8 border-b-4 border-r-4 border-cyan-400 rounded-br-lg"></div>
                                <div class="w-full h-1 bg-cyan-400/50 absolute top-0 animate-[scan_2s_infinite] shadow-[0_0_15px_rgba(34,211,238,0.8)]"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <h3 class="text-xs font-black text-slate-900 mb-6 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Validasi Manual / Barcode
                        </h3>
                        
                        <form action="{{ url('/organizer/checkin/verify') }}" method="POST">
                            @csrf
                            <div class="relative mb-4">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">confirmation_number</span>
                                <input type="text" name="booking_code" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-4 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/20 transition-all font-mono font-bold text-lg tracking-widest text-slate-900 uppercase" placeholder="KODE BOOKING TIKET" autofocus required autocomplete="off">
                            </div>
                            <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-bold text-xs flex items-center justify-center gap-2 shadow-lg shadow-slate-900/20 active:scale-95 transition-all uppercase tracking-widest cursor-pointer">
                                <span class="material-symbols-outlined text-sm">check_circle</span> Proses Check-In
                            </button>
                        </form>

                        @if(session('success'))
                            <div class="mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-100 shadow-sm animate-fade-in flex gap-3 items-start">
                                <span class="material-symbols-outlined text-emerald-600 text-xl">how_to_reg</span>
                                <div>
                                    <h4 class="font-black text-emerald-800 text-sm">Akses Diberikan!</h4>
                                    <p class="text-xs font-medium text-emerald-700 mt-0.5">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($errors->has('checkin_error'))
                            <div class="mt-4 p-4 rounded-xl bg-rose-50 border border-rose-100 shadow-sm animate-fade-in flex gap-3 items-start">
                                <span class="material-symbols-outlined text-rose-600 text-xl">cancel</span>
                                <div>
                                    <h4 class="font-black text-rose-800 text-sm">Akses Ditolak!</h4>
                                    <p class="text-xs font-medium text-rose-700 mt-0.5">{{ $errors->first('checkin_error') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-span-12 lg:col-span-7">
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden h-full flex flex-col min-h-[600px]">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-white sticky top-0 z-10">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 tracking-tight">Aktivitas Gerbang</h3>
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Sinkronisasi Cloud Aktif
                                </p>
                            </div>
                            <span class="material-symbols-outlined text-slate-300">history</span>
                        </div>
                        
                        <div id="activity-log" class="flex-1 overflow-y-auto p-6 space-y-4 bg-slate-50/30">
                            @forelse($history as $record)
                                <div class="flex items-center gap-4 p-5 bg-white rounded-3xl border border-slate-100 shadow-sm animate-fade-in group hover:border-emerald-200 transition-all">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-500/20">
                                        <span class="material-symbols-outlined">how_to_reg</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <h4 class="font-bold text-slate-900">{{ $record['participant_name'] ?? 'Peserta' }}</h4>
                                            <span class="text-[10px] font-mono text-slate-400 bg-slate-50 px-2 py-1 rounded-md">
                                                @if(!empty($record['checkin_time']))
                                                    {{ \Carbon\Carbon::parse($record['checkin_time'])->format('H:i:s') }} WIB
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-0.5">Kode: #{{ $record['booking_code'] ?? 'N/A' }} • <span class="font-bold text-cyan-600">{{ $record['event_title'] ?? '-' }}</span></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[9px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md uppercase tracking-tighter">Berhasil Masuk</span>
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center py-20 text-slate-400">
                                    <span class="material-symbols-outlined text-5xl mb-4 opacity-50">history_toggle_off</span>
                                    <p class="text-sm font-bold">Belum ada peserta yang melakukan check-in.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
        
        <style>
            @keyframes scan {
                0% { top: 0; opacity: 0.2; }
                50% { top: 100%; opacity: 0.8; }
                100% { top: 0; opacity: 0.2; }
            }
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in { animation: fade-in 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
            #activity-log::-webkit-scrollbar { width: 4px; }
            #activity-log::-webkit-scrollbar-track { background: transparent; }
            #activity-log::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        </style>
    </main>
@endsection