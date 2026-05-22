@extends('layout.app')

@section('title', 'Manage Organizer')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Manajemen Organizer</h2>
                    <p class="text-slate-500 mt-2 font-medium">Verifikasi identitas dan kelola hak akses akun Organizer platform.</p>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Menunggu Verifikasi</p>
                        <p class="text-2xl font-black text-amber-500">12 <span class="text-xs text-slate-300 font-bold">Akun</span></p>
                    </div>
                    <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Organizer</p>
                        <p class="text-2xl font-black text-slate-900">158 <span class="text-xs text-slate-300 font-bold">Akun</span></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm mb-8 flex gap-4 items-center">
                <div class="flex-1 relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
                    <input type="text" placeholder="Cari nama penyelenggara atau instansi..." class="w-full bg-slate-50 border-none rounded-xl pl-12 pr-4 py-2.5 text-xs font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500/20">
                </div>
                <select class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-500 focus:ring-2 focus:ring-cyan-500/20">
                    <option>Semua Status</option>
                    <option>Terverifikasi</option>
                    <option>Menunggu</option>
                    <option>Diblokir</option>
                </select>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black">
                                <th class="p-6 pl-10">Penyelenggara / Instansi</th>
                                <th class="p-6">Kontak & Email</th>
                                <th class="p-6">Total Event</th>
                                <th class="p-6">Status Akun</th>
                                <th class="p-6 pr-10 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6 pl-10">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                            <span class="material-symbols-outlined">corporate_fare</span>
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900 leading-tight">Architecture Studio Karawang</div>
                                            <div class="text-[10px] text-cyan-600 font-black uppercase tracking-widest mt-1">Lembaga Formal</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="font-bold text-slate-700">admin@arc-karawang.com</div>
                                    <div class="text-xs text-slate-400 font-medium">+62 812-3456-7890</div>
                                </td>
                                <td class="p-6">
                                    <div class="text-lg font-black text-slate-900">12</div>
                                    <div class="text-[9px] text-slate-400 font-bold uppercase">Event Aktif</div>
                                </td>
                                <td class="p-6">
                                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Terverifikasi</span>
                                </td>
                                <td class="p-6 pr-10 text-right">
                                    <button class="p-2 hover:bg-rose-50 rounded-lg transition-colors text-slate-300 hover:text-rose-500 group" title="Blokir Akses">
                                        <span class="material-symbols-outlined">block</span>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/50 transition-colors bg-amber-50/10">
                                <td class="p-6 pl-10">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
                                            <span class="material-symbols-outlined">person_pin</span>
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900 leading-tight">Budi Hartono</div>
                                            <div class="text-[10px] text-amber-600 font-black uppercase tracking-widest mt-1">Individu / Panitia</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="font-bold text-slate-700">budi.h@gmail.com</div>
                                    <div class="text-xs text-slate-400 font-medium">+62 812-3456-78678</div>
                                </td>
                                <td class="p-6">
                                    <div class="text-lg font-black text-slate-300">0</div>
                                    <div class="text-[9px] text-slate-400 font-bold uppercase">Baru Bergabung</div>
                                </td>
                                <td class="p-6">
                                    <span class="px-4 py-1.5 bg-amber-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm shadow-amber-500/20">Menunggu</span>
                                </td>
                                <td class="p-6 pr-10 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="px-4 py-2 bg-emerald-500 text-white rounded-xl text-[10px] font-black uppercase shadow-md shadow-emerald-500/20 hover:scale-105 transition-all">Verifikasi Akun</button>
                                        <button class="px-4 py-2 bg-slate-100 text-slate-400 rounded-xl text-[10px] font-black uppercase">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 p-8 bg-cyan-900 rounded-[2.5rem] text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-xl font-black mb-2 tracking-tight">Prosedur Kurasi Penyelenggara</h3>
                    <p class="text-cyan-100 text-sm max-w-2xl leading-relaxed opacity-80">
                        Sesuai kebijakan keamanan platform, setiap akun Organizer wajib melalui tahap validasi dokumen identitas. 
                        Pastikan nama instansi selaras dengan proposal event yang diajukan untuk menghindari penyalahgunaan hak akses aplikasi.
                    </p>
                </div>
                <span class="material-symbols-outlined absolute -right-10 -bottom-10 text-[200px] text-white/5 rotate-12">verified</span>
            </div>
        </div>
    </main>
@endsection