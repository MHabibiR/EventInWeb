@extends('layout.app')

@section('title', 'Dashboard Admin')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col font-inter">
        <div class="p-10 max-w-[1400px] mx-auto w-full space-y-10">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 primary-gradient rounded-2xl shadow-sm flex items-center justify-center overflow-hidden p-2 text-white">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">monitoring</span>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Platform Overview</h2>
                        <p class="text-slate-500 mt-1 font-medium text-sm">Pantau pertumbuhan ekosistem EventIn secara keseluruhan.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-cyan-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-cyan-50 group-hover:text-cyan-600 transition-colors">
                            <span class="material-symbols-outlined">event_available</span>
                        </div>
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-2 py-1 rounded">Aktif</span>
                    </div>
                    <div class="text-3xl font-black text-slate-900">{{ $stats['total_events'] ?? 0 }}</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Event Aktif</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-indigo-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                            <span class="material-symbols-outlined">corporate_fare</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-slate-900">{{ $stats['total_organizers'] ?? 0 }}</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Organizer Terdaftar</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:border-emerald-200 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-slate-900">{{ $stats['total_participants'] ?? 0 }}</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Peserta Sistem</p>
                </div>

                <div class="bg-amber-50/30 p-8 rounded-[2rem] border border-amber-100 shadow-sm group hover:border-amber-300 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-100/50 flex items-center justify-center text-amber-500 group-hover:bg-amber-100 group-hover:text-amber-700 transition-colors">
                            <span class="material-symbols-outlined">pending_actions</span>
                        </div>
                        <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest animate-pulse">Menunggu</span>
                    </div>
                    <div class="text-3xl font-black text-amber-600">{{ $stats['pending_proposals'] ?? 0 }}</div>
                    <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest mt-1">Proposal Butuh Review</p>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-lg font-black text-slate-900 tracking-tight font-headline">Status Event Terkini</h3>
                        <a href="{{ url('/admin/manage-events') }}" class="text-[10px] font-black text-cyan-600 uppercase tracking-widest hover:underline">Kelola Semua</a>
                    </div>
                    
                    <div class="divide-y divide-slate-50">
                        @forelse($stats['recent_events'] ?? [] as $event)
                            <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center font-bold text-slate-400 group-hover:bg-white group-hover:shadow-sm transition-all border border-transparent group-hover:border-slate-200">
                                        <span class="material-symbols-outlined text-cyan-600">event</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $event['title'] ?? 'Judul Tidak Tersedia' }}</h4>
                                        <p class="text-[10px] font-bold uppercase tracking-widest mt-1 text-slate-400">
                                            Status saat ini: <span class="text-slate-600">{{ $event['status'] ?? 'N/A' }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-4 py-1.5 bg-cyan-50 text-cyan-600 text-[10px] font-black rounded-full uppercase tracking-widest border border-cyan-100 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                        Cek Detail
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center p-12 bg-white">
                                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl text-slate-300">inbox</span>
                                </div>
                                <p class="text-sm font-bold text-slate-500">Belum ada aktivitas event terbaru.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl">
                        <div class="relative z-10">
                            <h3 class="text-sm font-black tracking-widest mb-6 text-slate-400 uppercase flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Keamanan Sistem
                            </h3>
                            <div class="space-y-6">
                                <div class="flex gap-4 p-4 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                                    <span class="material-symbols-outlined text-emerald-400">gpp_good</span>
                                    <div>
                                        <p class="text-xs font-bold text-slate-200">Organizer 'Studio Karawang' login</p>
                                        <p class="text-[10px] text-slate-400 font-mono mt-1">2 Menit yang lalu</p>
                                    </div>
                                </div>
                                </div>
                        </div>
                        <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[150px] text-white/5 rotate-12">admin_panel_settings</span>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection