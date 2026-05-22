@extends('layout.app')

@section('title', 'Check-in & Check-out')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Gate Control & Monitoring</h2>
                    <p class="text-slate-500 mt-2 font-medium">Validasi kehadiran masuk/keluar peserta dan pantau kuota acara secara real-time.</p>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm text-center min-w-[160px]">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Hadir Saat Ini</p>
                        <p class="text-3xl font-black text-cyan-600">4,210 <span class="text-xs text-slate-300 font-bold">/ 5,000</span></p>
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
                        
                        <div class="absolute inset-0 flex items-center justify-center">
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
                            <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Konfigurasi Gerbang
                        </h3>
                        
                        <div class="grid grid-cols-2 gap-2 p-1.5 bg-slate-100 rounded-2xl mb-8">
                            <button onclick="setMode('checkin')" id="mode-in" class="py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all bg-white text-cyan-600 shadow-sm">
                                <span class="flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-sm">login</span> Check-in
                                </span>
                            </button>
                            <button onclick="setMode('checkout')" id="mode-out" class="py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-slate-400 hover:text-slate-600">
                                <span class="flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-sm">logout</span> Check-out
                                </span>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <button class="py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs flex items-center justify-center gap-2 shadow-lg shadow-slate-900/20 active:scale-95 transition-all">
                                <span class="material-symbols-outlined text-sm">videocam</span> Mulai Scan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-7">
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden h-full flex flex-col min-h-[600px]">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-white sticky top-0 z-10">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 tracking-tight">Aktivitas Gerbang</h3>
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Sinkronisasi Cloud Aktif</p>
                            </div>
                            <span class="material-symbols-outlined text-slate-300">history</span>
                        </div>
                        
                        <div id="activity-log" class="flex-1 overflow-y-auto p-6 space-y-4 bg-slate-50/30">
                            <div class="flex items-center gap-4 p-5 bg-white rounded-3xl border border-slate-100 shadow-sm animate-fade-in group hover:border-emerald-200 transition-all">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-500/20">
                                    <span class="material-symbols-outlined">how_to_reg</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-slate-900">Kim Juun</h4>
                                        <span class="text-[10px] font-mono text-slate-400 bg-slate-50 px-2 py-1 rounded-md">20:45:07</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">ID: #MBG-2211 • <span class="font-bold text-cyan-600">VIP Ticket</span></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md uppercase tracking-tighter">Berhasil Masuk</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 p-5 bg-white rounded-3xl border border-slate-100 shadow-sm animate-fade-in group hover:border-rose-200 transition-all">
                                <div class="w-12 h-12 rounded-2xl bg-rose-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-rose-500/20">
                                    <span class="material-symbols-outlined">logout</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-slate-900">M.Habibi Rahman</h4>
                                        <span class="text-[10px] font-mono text-slate-400 bg-slate-50 px-2 py-1 rounded-md">21:15:30</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">Durasi Hadir: <span class="font-bold text-slate-700">2j 30m</span></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] font-black text-rose-600 bg-rose-50 px-2 py-1 rounded-md uppercase tracking-tighter">Berhasil Keluar</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 p-5 bg-white rounded-3xl border border-rose-100 shadow-sm">
                                <div class="w-12 h-12 rounded-2xl bg-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                                    <span class="material-symbols-outlined">warning</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-slate-900 italic opacity-60">Angelina</h4>
                                        <span class="text-[10px] font-mono text-slate-400">21:18:00</span>
                                    </div>
                                    <p class="text-xs text-rose-500 font-medium">Peringatan: Peserta sudah tercatat hadir sebelumnya.</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 border-t border-slate-100 text-center">
                            <button class="text-xs font-bold text-slate-400 hover:text-cyan-600 transition-colors uppercase tracking-widest">
                                Unduh Laporan Kehadiran (.CSV)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    /* Custom Scrollbar untuk Log agar tetap rapi */
    #activity-log::-webkit-scrollbar { width: 4px; }
    #activity-log::-webkit-scrollbar-track { background: transparent; }
    #activity-log::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>

    <script>
        function setMode(mode) {
            const btnIn = document.getElementById('mode-in');
            const btnOut = document.getElementById('mode-out');
            
            if(mode === 'checkin') {
                // Aktifkan Check-in
                btnIn.className = "py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all bg-white text-cyan-600 shadow-sm border border-slate-100";
                btnOut.className = "py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-slate-400 hover:text-slate-600";
                console.log("Mode Aktif: Check-in Peserta Datang");
            } else {
                // Aktifkan Check-out
                btnOut.className = "py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all bg-white text-rose-600 shadow-sm border border-slate-100";
                btnIn.className = "py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-slate-400 hover:text-slate-600";
                console.log("Mode Aktif: Check-out Peserta Pulang");
            }
        }
    </script>
@endsection