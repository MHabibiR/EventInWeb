@extends('layout.app')

@section('title', 'Daftar Peserta')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50 font-inter">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Direktori Peserta</h2>
                    <p class="text-slate-500 mt-2 font-medium">Kelola dan pantau status pembayaran seluruh peserta event Anda secara real-time.</p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white text-slate-600 px-6 py-3 rounded-2xl font-bold text-sm border border-slate-200 hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-sm">download</span> Ekspor .CSV
                    </button>
                    <button class="primary-gradient text-white px-6 py-3 rounded-2xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-cyan-500/20 active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-sm">person_add</span> Tambah Manual
                    </button>
                </div>
            </div>

            <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm mb-8 flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px] relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
                    <input type="text" placeholder="Cari nama atau kode booking..." class="w-full bg-slate-50 border-none rounded-xl pl-12 pr-4 py-2.5 text-xs font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500/20">
                </div>
                <div class="flex gap-2">
                    <select class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-500 focus:ring-2 focus:ring-cyan-500/20 cursor-pointer">
                        <option>Semua Status</option>
                        <option>Lunas</option>
                        <option>Pending</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-slate-300 transition-colors">
                    <div>
                        <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Total Peserta</div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['total_participants'] ?? 0 }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-colors">
                    <div>
                        <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Pembayaran Lunas</div>
                        <div class="text-3xl font-black text-emerald-600">{{ $stats['paid_participants'] ?? 0 }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">task_alt</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-amber-200 transition-colors">
                    <div>
                        <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Menunggu Bayar</div>
                        <div class="text-3xl font-black text-amber-600">{{ $stats['pending_participants'] ?? 0 }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-b border-slate-100">
                                <th class="p-6 pl-10">Data Peserta</th>
                                <th class="p-6">Event & Kategori</th>
                                <th class="p-6">Kode Booking</th>
                                <th class="p-6">Status Bayar</th>
                                <th class="p-6 pr-10 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($participants as $participant)
                                @php 
                                    $name = $participant['name'] ?? 'Unknown';
                                    $initials = strtoupper(substr($name, 0, 1));
                                    $status = $participant['status'] ?? '';
                                    $isPaid = ($status == 'confirmed' || $status == 'paid' || $status == 'lunas');
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="p-6 pl-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full {{ $isPaid ? 'primary-gradient text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center font-bold">
                                                {{ $initials }}
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-900">{{ $name }}</div>
                                                <div class="text-xs text-slate-400">{{ $participant['email'] ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="font-bold text-slate-700">{{ $participant['event_title'] ?? '-' }}</div>
                                        <div class="text-[10px] text-cyan-600 font-black uppercase tracking-widest mt-1">
                                            Kategori: {{ $participant['ticket_category'] ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <span class="font-mono text-xs font-bold text-slate-500 px-2 py-1 bg-slate-100 rounded uppercase">
                                            {{ $participant['booking_code'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="p-6">
                                        @if($isPaid)
                                            <div class="flex items-center gap-2 text-emerald-600 font-bold">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                <span class="text-xs">Lunas</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-2 text-amber-500 font-bold">
                                                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                                <span class="text-xs">Pending</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-6 pr-10 text-right">
                                        <button class="p-2 hover:bg-slate-100 rounded-lg transition-colors text-slate-400 cursor-pointer">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <span class="material-symbols-outlined text-5xl text-slate-300 mb-3">group_off</span>
                                            <p class="text-slate-500 font-medium">Belum ada peserta yang mendaftar ke event Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </main>
@endsection