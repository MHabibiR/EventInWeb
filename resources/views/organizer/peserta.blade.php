@extends('layout.app')

@section('title', 'Daftar Peserta')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Daftar Peserta</h2>
                    <p class="text-slate-500 mt-2 font-medium">Kelola dan pantau status pembayaran seluruh peserta event Anda.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Peserta</p>
                        <p class="text-2xl font-black text-slate-900">{{ $stats['total_participants'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">task_alt</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pembayaran Lunas</p>
                        <p class="text-2xl font-black text-slate-900">{{ $stats['paid_participants'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menunggu Bayar</p>
                        <p class="text-2xl font-black text-slate-900">{{ $stats['pending_participants'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-y border-slate-100">
                                <th class="p-6 pl-10">Data Peserta</th>
                                <th class="p-6">Event & Kategori</th>
                                <th class="p-6 text-center">Kode Booking</th>
                                <th class="p-6 pr-10 text-right">Status Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($participants as $participant)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="p-6 pl-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-600">
                                                {{ substr($participant['name'], 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-900">{{ $participant['name'] }}</div>
                                                <div class="text-xs text-slate-500">{{ $participant['email'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="font-bold text-slate-700">{{ $participant['event_title'] }}</div>
                                        <div class="text-[10px] text-cyan-600 font-black uppercase tracking-widest mt-1">
                                            Kategori: {{ $participant['ticket_category'] }}
                                        </div>
                                    </td>
                                    <td class="p-6 text-center">
                                        <span class="font-mono font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg tracking-wider text-xs">
                                            {{ $participant['booking_code'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="p-6 pr-10 text-right">
                                        @if($participant['status'] == 'confirmed' || $participant['status'] == 'paid')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Lunas</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-full border border-amber-100 uppercase tracking-widest">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-12 text-center">
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