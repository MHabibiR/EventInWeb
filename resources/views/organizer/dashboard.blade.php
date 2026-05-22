@extends('layout.app')

@section('title', 'Dashboard Organizer')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center justify-center overflow-hidden p-2">
                        <span class="material-symbols-outlined text-4xl text-cyan-600">architecture</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Architecture Design Summit 2026</h2>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase">Status: Open</span>
                        </div>
                        <p class="text-slate-500 mt-1 font-medium flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">location_on</span> Southbank Centre, London • 12 Oktober 2026
                        </p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white text-slate-600 px-6 py-3 rounded-2xl font-bold text-xs border border-slate-200 hover:bg-slate-50 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">settings</span> Atur Detail Acara
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-cyan-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-cyan-50 group-hover:text-cyan-600 transition-colors">
                            <span class="material-symbols-outlined">group</span>
                        </div>
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">+12 Baru</span>
                    </div>
                    <div class="text-3xl font-black text-slate-900">4,210</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Pendaftar Terkonfirmasi</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-emerald-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                            <span class="material-symbols-outlined">qr_code_scanner</span>
                        </div>
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">84% Hadir</span>
                    </div>
                    <div class="text-3xl font-black text-slate-900">3,892</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Check-in Real-time</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-amber-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-amber-50 group-hover:text-amber-600 transition-colors">
                            <span class="material-symbols-outlined">event_seat</span>
                        </div>
                        <span class="text-[10px] font-black text-amber-500 uppercase tracking-widest">Sisa 108</span>
                    </div>
                    <div class="text-3xl font-black text-slate-900">145 / 250</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Okupansi Kursi VIP</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-cyan-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-cyan-50 group-hover:text-cyan-600 transition-colors">
                            <span class="material-symbols-outlined">celebration</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Idle</span>
                    </div>
                    <div class="text-3xl font-black text-slate-900">12</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Hadiah Undian Tersedia</p>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-8 space-y-8">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm h-80 relative flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-black text-slate-900 tracking-tight">Progres Kedatangan Peserta</h3>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-widest mt-1">Statistik per Jam (Hari-H)</p>
                        </div>
                        <div class="flex items-end justify-between gap-2 h-40">
                            <?php for($i=1; $i<=12; $i++): $h = rand(20, 100); ?>
                                <div class="flex-1 bg-slate-50 rounded-t-xl relative group">
                                    <div class="absolute bottom-0 w-full primary-gradient rounded-t-xl transition-all duration-1000" style="height: <?= $h ?>%"></div>
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[8px] font-bold px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                        <?= rand(100, 500) ?> Pax
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                            <h3 class="text-lg font-black text-slate-900 tracking-tight">Pendaftaran Terbaru</h3>
                            <a href="peserta.php" class="text-[10px] font-black text-cyan-600 uppercase tracking-widest hover:underline">Lihat Semua</a>
                        </div>
                        <div class="divide-y divide-slate-50">
                            <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-400 text-xs text-uppercase">JD</div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Jonathan Doe</h4>
                                        <p class="text-[10px] text-slate-400 font-medium">jonathan.d@example.com</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-0.5 bg-amber-50 text-amber-600 text-[9px] font-black rounded uppercase">VIP Ticket</span>
                                    <p class="text-[9px] text-slate-400 mt-1">2 Menit yang lalu</p>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl">
                        <div class="relative z-10">
                            <h3 class="text-lg font-black tracking-tight mb-2">Gate Operational</h3>
                            <p class="text-xs text-slate-400 font-medium leading-relaxed mb-8">Siap menyambut peserta? Buka terminal scanner untuk mulai memvalidasi tiket QR peserta.</p>
                            <a href="checkin.php" class="inline-flex items-center gap-2 bg-white text-slate-900 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-white/5">
                                <span class="material-symbols-outlined text-lg">qr_code_scanner</span>
                                Launch Scanner
                            </a>
                        </div>
                        <span class="material-symbols-outlined absolute -right-8 -bottom-8 text-[150px] text-white/5 rotate-12">confirmation_number</span>
                    </div>

                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                        <h3 class="text-sm font-black text-slate-900 mb-6 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Modul Operasional
                        </h3>
                        <div class="grid grid-cols-1 gap-3">
                            <a href="seating.php" class="p-4 bg-slate-50 rounded-2xl flex items-center justify-between group hover:bg-cyan-50 transition-all border border-transparent hover:border-cyan-100">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-cyan-600">event_seat</span>
                                    <span class="text-xs font-bold text-slate-600 group-hover:text-cyan-900">Seat Management</span>
                                </div>
                                <span class="material-symbols-outlined text-slate-300 group-hover:translate-x-1 transition-transform">chevron_right</span>
                            </a>
                            <a href="lucky_draw.php" class="p-4 bg-slate-50 rounded-2xl flex items-center justify-between group hover:bg-amber-50 transition-all border border-transparent hover:border-amber-100">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-amber-600">celebration</span>
                                    <span class="text-xs font-bold text-slate-600 group-hover:text-amber-900">Run Lucky Draw</span>
                                </div>
                                <span class="material-symbols-outlined text-slate-300 group-hover:translate-x-1 transition-transform">chevron_right</span>
                            </a>
                            <a href="sertifikat.php" class="p-4 bg-slate-50 rounded-2xl flex items-center justify-between group hover:bg-emerald-50 transition-all border border-transparent hover:border-emerald-100">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-emerald-600">card_membership</span>
                                    <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-900">E-Certificate Batch</span>
                                </div>
                                <span class="material-symbols-outlined text-slate-300 group-hover:translate-x-1 transition-transform">chevron_right</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection