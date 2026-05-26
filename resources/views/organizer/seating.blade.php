@extends('layout.app')

@section('title', 'Manajemen Tempat Duduk')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50 font-inter">
        
        <div class="px-8 py-4 border-b border-slate-100 bg-white flex items-center justify-between sticky top-20 z-30 shadow-sm">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Manajemen Tempat Duduk</h2>
                <p class="text-[10px] font-black text-cyan-600 uppercase tracking-widest mt-0.5">
                    Visualisasi Penempatan Peserta
                </p>
            </div>
            <div class="flex items-center gap-4">
                <form action="{{ url('/organizer/seating') }}" method="GET" id="event-filter-form" class="m-0">
                    <select name="event_id" onchange="document.getElementById('event-filter-form').submit()" class="bg-slate-50 text-slate-700 px-4 py-2.5 rounded-xl font-bold text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500/20 border border-slate-200 cursor-pointer shadow-sm">
                        @foreach($events as $event)
                            <option value="{{ $event['id'] }}" {{ ($selectedEventId ?? '') == $event['id'] ? 'selected' : '' }}>
                                {{ $event['title'] }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <button class="primary-gradient text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-cyan-500/20 active:scale-95 transition-all">
                    Simpan Tata Letak
                </button>
            </div>
        </div>
        
        <div class="flex-1 flex overflow-hidden relative">
            <div id="visual-area" class="flex-1 p-12 flex flex-col items-center justify-start relative overflow-auto transition-all duration-500 ease-in-out">
                
                <div class="flex flex-wrap gap-6 mb-12 bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-md bg-emerald-500 shadow-sm"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Tersedia ({{ $stats['available_seats'] ?? 0 }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-md bg-rose-500 shadow-sm"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Sudah Dipesan ({{ $stats['occupied_seats'] ?? 0 }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-md bg-slate-200"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Total Slot ({{ $stats['total_seats'] ?? 0 }})</span>
                    </div>
                </div>

                <div class="w-full max-w-2xl h-12 bg-slate-200 rounded-t-[3rem] border-b-8 border-slate-300 flex items-center justify-center mb-24 relative shadow-sm">
                    <span class="font-black text-slate-400 uppercase text-xs tracking-[0.3em]">Area Panggung / Layar</span>
                    <div class="absolute -bottom-16 w-full h-8 bg-gradient-to-b from-slate-200/50 to-transparent"></div>
                </div>
                
                <div class="grid grid-cols-6 md:grid-cols-10 gap-4 max-w-4xl w-full justify-center">
                    @forelse($seats as $seat)
                        @php 
                            $isBooked = ($seat['status'] ?? '') === 'occupied';
                            $seatNumber = $seat['seat_number'] ?? '-';
                            $category = $seat['category_name'] ?? 'Regular';
                            $pName = addslashes($seat['participant_name'] ?? 'Peserta');
                            $bCode = $seat['booking_code'] ?? 'N/A';
                            
                            $bgColor = $isBooked ? 'bg-rose-500' : 'bg-emerald-500';
                        @endphp
                        
                        <div onclick="viewSeat('{{ $seatNumber }}', '{{ $category }}', {{ $isBooked ? 'true' : 'false' }}, '{{ $pName }}', '{{ $bCode }}')" 
                            class="relative w-12 h-12 rounded-t-xl rounded-b-md {{ $bgColor }} cursor-pointer hover:scale-110 hover:-translate-y-1 transition-all flex flex-col items-center justify-center text-xs font-bold text-white shadow-sm shadow-slate-300 group">
                            {{ $seatNumber }}
                        </div>
                    @empty
                        <div class="col-span-10 text-center py-12 text-slate-400 flex flex-col items-center">
                            <span class="material-symbols-outlined text-5xl mb-3 opacity-50">event_seat</span>
                            <p class="text-sm font-bold">Data denah kursi tidak ditemukan atau belum diatur untuk acara ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div id="seat-detail" class="fixed right-0 top-20 bottom-0 w-80 bg-white border-l border-slate-100 p-8 transform translate-x-full transition-transform duration-500 ease-in-out shadow-2xl z-50 overflow-y-auto">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Detail Kursi</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Informasi Real-time</p>
                    </div>
                    <button onclick="closeDetail()" class="text-slate-400 hover:text-rose-500 transition-colors cursor-pointer bg-slate-50 p-2 rounded-full hover:bg-rose-50">
                        <span class="material-symbols-outlined text-xl block">close</span>
                    </button>
                </div>

                <div id="seat-info" class="space-y-6">
                    <div class="text-center p-8 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">touch_app</span>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">Pilih kursi untuk melihat detail peserta</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function viewSeat(id, category, isBooked, participantName, bookingCode) {
            const detailPanel = document.getElementById('seat-detail');
            const visualArea = document.getElementById('visual-area');
            const infoContainer = document.getElementById('seat-info');
            
            detailPanel.classList.remove('translate-x-full');
            
            // Atur margin agar view grid tidak tertutup panel kanan (khusus layar lebar)
            if(window.innerWidth > 1024) {
                visualArea.style.marginRight = "320px";
            }
            
            if(isBooked) {
                infoContainer.innerHTML = `
                    <div class="bg-rose-50 p-6 rounded-3xl border border-rose-100 animate-fade-in">
                        <div class="flex justify-between items-center mb-4">
                            <span class="px-3 py-1 bg-rose-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">Booked</span>
                            <span class="text-2xl font-black text-slate-900">${id}</span>
                        </div>
                        <div class="space-y-4 pt-4 border-t border-rose-200/50">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Peserta</label>
                                <p class="font-bold text-slate-900">${participantName}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ticket ID</label>
                                <p class="font-mono text-sm text-slate-600">#${bookingCode}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori Tiket</label>
                                <p class="font-bold text-rose-700">${category}</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full py-4 text-xs font-black text-rose-600 bg-white rounded-2xl hover:bg-rose-100 transition-colors uppercase tracking-widest border border-rose-200 cursor-pointer shadow-sm">Kelola Pemesanan</button>
                `;
            } else {
                infoContainer.innerHTML = `
                    <div class="bg-emerald-50 p-6 rounded-3xl border border-emerald-100 animate-fade-in">
                        <div class="flex justify-between items-center mb-4">
                            <span class="px-3 py-1 bg-emerald-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">Tersedia</span>
                            <span class="text-2xl font-black text-slate-900">${id}</span>
                        </div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
                            Kursi ini tersedia di area kategori <span class="text-emerald-700">${category}</span>.
                        </p>
                    </div>
                    <button class="w-full py-4 text-xs font-black text-white primary-gradient rounded-2xl shadow-lg shadow-cyan-500/20 hover:scale-[1.02] active:scale-95 transition-all uppercase tracking-widest cursor-pointer">Daftarkan Peserta Manual</button>
                `;
            }
        }

        function closeDetail() {
            const detailPanel = document.getElementById('seat-detail');
            const visualArea = document.getElementById('visual-area');
            
            detailPanel.classList.add('translate-x-full');
            visualArea.style.marginRight = "0px";
        }
        </script>

        <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
        </style>
    </main>
@endsection