@extends('layout.app')

@section('title', 'Peserta')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Direktori Peserta</h2>
                    <p class="text-slate-500 mt-2 font-medium">Pantau data registrasi, kategori, dan status kehadiran secara real-time.</p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white text-slate-600 px-6 py-3 rounded-2xl font-bold text-sm border border-slate-200 hover:bg-slate-50 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">download</span> Ekspor .CSV
                    </button>
                    <button class="primary-gradient text-white px-6 py-3 rounded-2xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-cyan-500/20">
                        <span class="material-symbols-outlined text-sm">person_add</span> Tambah Manual
                    </button>
                </div>
            </div>

            <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm mb-8 flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px]">
                    <select class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-600 focus:outline-none">
                        <option>Architecture Design Summit 2024</option>
                        <option>Future Cities Initiative</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <select class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-500 focus:outline-none">
                        <option>Semua Status</option>
                        <option>Sudah Check-in</option>
                        <option>Belum Hadir</option>
                    </select>
                    <select class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-500 focus:outline-none">
                        <option>Semua Kategori</option>
                        <option>VIP</option>
                        <option>Regular</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2">Total Terdaftar</div>
                    <div class="text-3xl font-black text-slate-900">4,210</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2">Sudah Hadir</div>
                    <div class="text-3xl font-black text-emerald-600">3,892</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2">Peserta VIP</div>
                    <div class="text-3xl font-black text-amber-600">145</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2">Belum Check-in</div>
                    <div class="text-3xl font-black text-rose-600">318</div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black">
                                <th class="p-6 pl-10">Data Peserta</th>
                                <th class="p-6">ID Tiket</th>
                                <th class="p-6">Kategori & Kursi</th> <th class="p-6">Kehadiran</th>
                                <th class="p-6 pr-10 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6 pl-10">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center text-white font-bold">K.J</div>
                                        <div>
                                            <div class="font-black text-slate-900">Kim Juun</div>
                                            <div class="text-xs text-slate-400">K.Juun@H2H.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span class="font-mono text-xs font-bold text-slate-500">#MBG-211</span>
                                </td>
                                <td class="p-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="px-2 py-0.5 bg-amber-50 text-amber-600 text-[9px] font-black rounded uppercase w-fit">VIP Class</span>
                                        <span class="text-xs font-bold text-slate-700">Seat: A-08</span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-2 text-emerald-600 font-bold">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span class="text-xs">Checked In</span>
                                    </div>
                                    <div class="text-[9px] text-slate-400 font-medium ml-4 mt-0.5">20:45 WIB</div>
                                </td>
                                <td class="p-6 pr-10 text-right">
                                    <button class="p-2 hover:bg-slate-100 rounded-lg transition-colors text-slate-400">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6 pl-10">
                                    <div class="flex items-center gap-4 opacity-70">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold">MHR</div>
                                        <div>
                                            <div class="font-black text-slate-900">Muhammad Habibi Rahman</div>
                                            <div class="text-xs text-slate-400">M.HabibiR@ubp.ac.id</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span class="font-mono text-xs font-bold text-slate-500">#USR-1005</span>
                                </td>
                                <td class="p-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase w-fit">Regular</span>
                                        <span class="text-xs font-bold text-slate-700">Seat: B-12</span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-2 text-slate-300 font-bold">
                                        <span class="w-2 h-2 rounded-full bg-slate-200"></span>
                                        <span class="text-xs italic">Belum Hadir</span>
                                    </div>
                                </td>
                                <td class="p-6 pr-10 text-right">
                                    <button class="p-2 hover:bg-slate-100 rounded-lg transition-colors text-slate-400">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection