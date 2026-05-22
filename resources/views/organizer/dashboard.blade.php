@extends('layout.app')

@section('title', 'Dashboard Organizer')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Ringkasan Operasional</h2>
                <p class="text-slate-500 mt-2 font-medium">Pantau performa event, pendaftaran peserta, dan pendapatan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm transition-transform hover:-translate-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Event Aktif</p>
                    <div class="text-4xl font-black text-cyan-600">{{ $stats['active_events'] ?? 0 }}</div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm transition-transform hover:-translate-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Pendaftar</p>
                    <div class="text-4xl font-black text-emerald-600">{{ $stats['total_participants'] ?? 0 }}</div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm transition-transform hover:-translate-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Pendapatan Tiket</p>
                    <div class="text-3xl font-black text-slate-900 mt-2">
                        Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900">Pendaftaran Terbaru</h3>
                    <a href="{{ url('/organizer/peserta') }}" class="text-xs font-bold text-cyan-600 hover:underline">Lihat Semua Data</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-y border-slate-100">
                                <th class="p-6 pl-10">Data Peserta</th>
                                <th class="p-6">Nama Event</th>
                                <th class="p-6">Waktu Daftar</th>
                                <th class="p-6 pr-10 text-right">Status Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($stats['recent_registrations'] ?? [] as $reg)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-6 pl-10">
                                        <div class="font-bold text-slate-900">{{ $reg['participant_name'] }}</div>
                                        <div class="text-xs text-slate-500">{{ $reg['email'] }}</div>
                                    </td>
                                    <td class="p-6">
                                        <span class="font-medium text-slate-700 bg-slate-100 px-3 py-1 rounded-lg text-xs">{{ $reg['event_title'] }}</span>
                                    </td>
                                    <td class="p-6 text-xs font-bold text-slate-500">
                                        {{ \Carbon\Carbon::parse($reg['created_at'])->format('d M Y, H:i') }}
                                    </td>
                                    <td class="p-6 pr-10 text-right">
                                        @if($reg['status'] == 'confirmed')
                                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Lunas</span>
                                        @else
                                            <span class="px-3 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-full border border-amber-100 uppercase tracking-widest">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <span class="material-symbols-outlined text-4xl text-slate-300 mb-3">receipt_long</span>
                                            <p class="text-slate-500 font-medium text-sm">Belum ada pendaftaran tiket baru masuk.</p>
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