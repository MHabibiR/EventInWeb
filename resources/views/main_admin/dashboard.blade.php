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
                        <span class="text-3xl font-black text-slate-900">128</span>
                        <span class="text-xs font-bold text-emerald-500 mb-1">+5 Bulan Ini</span>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Pengguna (Mobile)</p>
                    <div class="text-3xl font-black text-slate-900">12,450</div>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm border-l-4 border-l-amber-500">
                    <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-2">Proposal Pending</p>
                    <div class="text-3xl font-black text-slate-900">14</div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="text-lg font-black text-slate-900">Antrean Pengajuan Event</h3>
                        <a href="main_admin/proposals.php" class="text-[10px] font-black text-cyan-600 uppercase tracking-widest hover:underline">Kelola Semua</a>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-colors group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:text-cyan-600">
                                    <span class="material-symbols-outlined">description</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">Tech Expo 2026</h4>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">Oleh: Digital Creative Corp</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[9px] font-black rounded-full uppercase">Review Needed</span>
                        </div>
                    </div>
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