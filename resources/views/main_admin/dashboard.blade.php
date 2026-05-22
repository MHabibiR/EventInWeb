@extends('layout.app')

@section('title', 'Dashboard Admin')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Platform Overview</h2>
                <p class="text-slate-500 mt-2 font-medium">Pantau pertumbuhan ekosistem EventIn secara keseluruhan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Event Aktif</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-black text-slate-900">{{ $stats['total_events'] ?? 0 }}</span>
                        <span class="text-xs font-bold text-emerald-500 mb-1">Via API</span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Organizer</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-black text-slate-900">{{ $stats['total_organizers'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Peserta</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-black text-slate-900">{{ $stats['total_participants'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] border border-amber-100 shadow-sm bg-amber-50/20">
                    <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-2">Proposal Menunggu</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-black text-amber-600">{{ $stats['pending_proposals'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <div class="space-y-4">
                    @forelse($stats['recent_events'] ?? [] as $event)
                        <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:border-cyan-200 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-cyan-600">event_available</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">{{ $event['title'] ?? 'Judul Tidak Tersedia' }}</h4>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                        Status saat ini: <span class="text-slate-600">{{ $event['status'] ?? 'N/A' }}</span>
                                    </p>
                                </div>
                            </div>
                            <span class="px-4 py-1.5 bg-cyan-50 text-cyan-600 text-[10px] font-black rounded-full uppercase tracking-widest border border-cyan-100">
                                Cek Detail
                            </span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center p-10 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                            <span class="material-symbols-outlined text-4xl text-slate-300 mb-3">inbox</span>
                            <p class="text-sm font-bold text-slate-500">Tidak ada aktivitas terbaru.</p>
                        </div>
                    @endforelse
                </div>

                <div class="col-span-12 lg:col-span-4 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xs font-black text-slate-900 mb-6 uppercase tracking-widest">Keamanan Sistem</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-emerald-500 text-sm">login</span>
                            <div>
                                <p class="text-[11px] text-slate-600 font-medium">Organizer 'Studio Karawang' berhasil masuk.</p>
                                <p class="text-[9px] text-slate-400 font-mono mt-0.5">2 Menit yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection