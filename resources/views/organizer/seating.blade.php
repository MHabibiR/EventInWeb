@extends('layout.app')

@section('title', 'Denah Kursi Event')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Manajemen Denah Kursi</h2>
                    <p class="text-slate-500 mt-2 font-medium">Visualisasi penempatan tempat duduk peserta secara real-time.</p>
                </div>
                
                <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-sm min-w-[280px]">
                    <form action="{{ url('/organizer/seating') }}" method="GET" id="event-filter-form">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 pl-1">Pilih Acara</label>
                        <select name="event_id" onchange="document.getElementById('event-filter-form').submit()" class="w-full bg-transparent font-bold text-slate-800 focus:outline-none text-sm cursor-pointer">
                            @foreach($events as $event)
                                <option value="{{ $event['id'] }}" {{ $selectedEventId == $event['id'] ? 'selected' : '' }}>
                                    {{ $event['title'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kapasitas Kursi</p>
                        <p class="text-2xl font-black text-slate-900 mt-1">{{ $stats['total_seats'] ?? 0 }} <span class="text-xs text-slate-400 font-medium">Slot</span></p>
                    </div>
                    <span class="material-symbols-outlined text-slate-200 text-4xl">event_seat</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Kursi Terisi</p>
                        <p class="text-2xl font-black text-emerald-600 mt-1">{{ $stats['occupied_seats'] ?? 0 }} <span class="text-xs text-emerald-400 font-medium">Booked</span></p>
                    </div>
                    <span class="material-symbols-outlined text-emerald-100 text-4xl">person_pin</span>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-cyan-600 uppercase tracking-widest">Kursi Tersedia</p>
                        <p class="text-2xl font-black text-cyan-600 mt-1">{{ $stats['available_seats'] ?? 0 }} <span class="text-xs text-cyan-400 font-medium">Kosong</span></p>
                    </div>
                    <span class="material-symbols-outlined text-cyan-100 text-4xl">chair_alt</span>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10 flex flex-col items-center">
                
                <div class="w-full max-w-2xl bg-slate-900 text-slate-400 text-center py-3 rounded-xl font-black text-xs uppercase tracking-[0.3em] mb-16 shadow-md">
                    PANGGUNG / LAYAR UTAMA
                </div>

                <div class="grid grid-cols-6 md:grid-cols-10 gap-4 max-w-4xl w-full justify-center">
                    @forelse($seats as $seat)
                        <div class="relative group aspect-square flex flex-col items-center justify-center rounded-xl font-mono text-xs font-bold border transition-all 
                            {{ $seat['status'] === 'occupied' 
                                ? 'bg-emerald-500 text-white border-emerald-600 shadow-sm' 
                                : 'bg-slate-50 text-slate-500 border-slate-200 hover:border-cyan-500 hover:bg-cyan-50/30' }}">
                            
                            {{ $seat['seat_number'] }}

                            <div class="absolute bottom-full mb-2 bg-slate-900 text-white text-[10px] py-1.5 px-3 rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all whitespace-nowrap z-10 shadow-xl">
                                @if($seat['status'] === 'occupied')
                                    Keterangan: Dinikmati oleh {{ $seat['participant_name'] ?? 'Peserta' }} ({{ $seat['category_name'] ?? 'VIP' }})
                                @else
                                    Status: Tersedia ({{ $seat['category_name'] ?? 'Reguler' }})
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-10 text-center py-12 text-slate-400">
                            <span class="material-symbols-outlined text-4xl mb-2 opacity-50">grid_off</span>
                            <p class="text-sm font-bold">Data denah kursi tidak ditemukan atau belum diatur untuk acara ini.</p>
                        </div>
                    @endforelse
                </div>

                <div class="flex gap-6 mt-16 border-t border-slate-100 pt-8 w-full justify-center text-xs font-bold">
                    <div class="flex items-center gap-2 text-slate-500">
                        <div class="w-4 h-4 bg-slate-50 border border-slate-200 rounded-md"></div>
                        <span>Kursi Kosong (Tersedia)</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-500">
                        <div class="w-4 h-4 bg-emerald-500 rounded-md"></div>
                        <span>Kursi Terisi (Sudah Dibooking)</span>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection