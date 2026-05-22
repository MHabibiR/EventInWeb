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
                        <p class="text-2xl font-black text-amber-500">{{ $stats['pending'] }} <span class="text-xs text-slate-300 font-bold">Akun</span></p>
                    </div>
                    <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Organizer</p>
                        <p class="text-2xl font-black text-slate-900">{{ $stats['total'] }} <span class="text-xs text-slate-300 font-bold">Akun</span></p>
                    </div>
                </div>
                @if(session('success'))
                    <div class="mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                        <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                    </div>
                @endif
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
                            @forelse($organizers as $org)
                                <tr class="hover:bg-slate-50/50 transition-colors {{ $org['status'] == 'pending' ? 'bg-amber-50/10' : '' }}">
                                    <td class="p-6 pl-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl {{ $org['status'] == 'pending' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center">
                                                <span class="material-symbols-outlined">{{ $org['type'] == 'Individu' ? 'person_pin' : 'corporate_fare' }}</span>
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-900 leading-tight">{{ $org['name'] }}</div>
                                                <div class="text-[10px] text-cyan-600 font-black uppercase tracking-widest mt-1">{{ $org['type'] ?? 'Organizer' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="font-bold text-slate-700">{{ $org['email'] }}</div>
                                        <div class="text-xs text-slate-400 font-medium">{{ $org['phone'] ?? '-' }}</div>
                                    </td>
                                    <td class="p-6">
                                        <div class="text-lg font-black text-slate-900">{{ $org['total_events'] ?? 0 }}</div>
                                        <div class="text-[9px] text-slate-400 font-bold uppercase">Event Dibuat</div>
                                    </td>
                                    <td class="p-6">
                                        @if($org['status'] == 'verified')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Terverifikasi</span>
                                        @elseif($org['status'] == 'pending')
                                            <span class="px-4 py-1.5 bg-amber-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm shadow-amber-500/20">Menunggu</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-rose-50 text-rose-600 text-[10px] font-black rounded-full border border-rose-100 uppercase tracking-widest">Diblokir</span>
                                        @endif
                                    </td>
                                    <td class="p-6 pr-10 text-right">
                                        
                                        @if($org['status'] == 'pending')
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ url('/admin/manage_organizer/' . $org['id'] . '/status') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="verified">
                                                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-xl text-[10px] font-black uppercase shadow-md shadow-emerald-500/20 hover:scale-105 transition-all">Verifikasi</button>
                                                </form>
                                                
                                                <form action="{{ url('/admin/manage_organizer/' . $org['id'] . '/status') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="rejected">
                                                    <button type="submit" class="px-4 py-2 bg-slate-100 text-slate-400 rounded-xl text-[10px] font-black uppercase hover:bg-slate-200">Tolak</button>
                                                </form>
                                            </div>
                                        @else
                                            <form action="{{ url('/admin/manage_organizer/' . $org['id'] . '/status') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="blocked">
                                                <button type="submit" class="p-2 hover:bg-rose-50 rounded-lg transition-colors text-slate-300 hover:text-rose-500 group" title="Blokir Akses">
                                                    <span class="material-symbols-outlined">block</span>
                                                </button>
                                            </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-slate-400">Belum ada data organizer yang terdaftar.</td>
                                </tr>
                            @endforelse
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