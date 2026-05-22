@extends('layout.app')

@section('title', 'Gate Check-In')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Gate Check-In</h2>
                    <p class="text-slate-500 mt-2 font-medium">Validasi tiket peserta dan catat kehadiran di lokasi acara.</p>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8 mb-10">
                
                <div class="col-span-12 lg:col-span-5 flex flex-col gap-6">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/20">
                        <div class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-3xl">qr_code_scanner</span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">Pindai atau Ketik Tiket</h3>
                        <p class="text-sm text-slate-500 mb-8">Masukkan kode booking (Contoh: EVT-12345). Jika menggunakan barcode scanner, pastikan kursor berada di kolom bawah ini.</p>
                        
                        <form action="{{ url('/organizer/checkin/verify') }}" method="POST">
                            @csrf
                            <div class="relative mb-4">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">confirmation_number</span>
                                <input type="text" name="booking_code" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-4 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 transition-all font-mono font-bold text-lg tracking-widest text-slate-900 uppercase" placeholder="KODE BOOKING" autofocus required autocomplete="off">
                            </div>
                            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-4 px-4 rounded-xl transition-colors shadow-lg shadow-cyan-600/30 uppercase tracking-widest text-sm">
                                Validasi Tiket
                            </button>
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm animate-fade-in flex gap-4 items-start">
                            <span class="material-symbols-outlined text-emerald-600 text-3xl">check_circle</span>
                            <div>
                                <h4 class="font-black text-emerald-800">Akses Diberikan!</h4>
                                <p class="text-sm font-medium text-emerald-700 mt-1">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->has('checkin_error'))
                        <div class="p-6 rounded-2xl bg-rose-50 border border-rose-200 shadow-sm animate-fade-in flex gap-4 items-start">
                            <span class="material-symbols-outlined text-rose-600 text-3xl">cancel</span>
                            <div>
                                <h4 class="font-black text-rose-800">Akses Ditolak!</h4>
                                <p class="text-sm font-medium text-rose-700 mt-1">{{ $errors->first('checkin_error') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-span-12 lg:col-span-7 flex flex-col gap-6">
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Telah Hadir</p>
                                <p class="text-3xl font-black text-emerald-600 mt-1">{{ $stats['total_checked_in'] ?? 0 }}</p>
                            </div>
                            <span class="material-symbols-outlined text-emerald-100 text-5xl">how_to_reg</span>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum Hadir</p>
                                <p class="text-3xl font-black text-amber-600 mt-1">{{ $stats['remaining'] ?? 0 }}</p>
                            </div>
                            <span class="material-symbols-outlined text-amber-100 text-5xl">hourglass_empty</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm flex-1 overflow-hidden flex flex-col">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Riwayat Kehadiran Terbaru</h3>
                        </div>
                        <div class="overflow-y-auto flex-1 max-h-[400px]">
                            <table class="w-full text-left border-collapse">
                                <tbody class="text-sm divide-y divide-slate-100">
                                    @forelse($history as $record)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="p-4 pl-6">
                                                <div class="font-bold text-slate-900">{{ $record['participant_name'] }}</div>
                                                <div class="text-[10px] text-slate-500 font-mono mt-1">{{ $record['booking_code'] }}</div>
                                            </td>
                                            <td class="p-4">
                                                <div class="text-xs text-slate-600 font-medium">{{ $record['event_title'] }}</div>
                                            </td>
                                            <td class="p-4 pr-6 text-right">
                                                <div class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Berhasil Check-In</div>
                                                <div class="text-xs text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($record['checkin_time'])->format('H:i:s') }} WIB</div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="p-10 text-center text-slate-400">
                                                <span class="material-symbols-outlined text-3xl mb-2 opacity-50">history_toggle_off</span>
                                                <p class="text-xs font-medium">Belum ada peserta yang melakukan check-in.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </main>

    <style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
    </style>
@endsection