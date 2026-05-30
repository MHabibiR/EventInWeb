@extends('layout.app')

@section('title', 'Mesin Undian Berhadiah')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col font-inter bg-slate-50">
        <div class="p-8 max-w-[1400px] mx-auto w-full h-full flex flex-col">
            
            <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Mesin Undian Berhadiah</h2>
                    <p class="text-slate-500 font-medium mt-1">Pilih pemenang secara acak dari peserta yang sudah hadir.</p>
                </div>
                <div class="w-full md:w-80">
                    <form action="{{ url('/organizer/lucky_draw') }}" method="GET" id="event-filter-form">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Acara Aktif</label>
                        <select name="event_id" onchange="document.getElementById('event-filter-form').submit()" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-cyan-500/50 cursor-pointer text-slate-700 shadow-sm">
                            @forelse($events ?? [] as $event)
                                <option value="{{ $event['id'] }}" {{ ($selectedEventId ?? '') == $event['id'] ? 'selected' : '' }}>
                                    {{ $event['nama_event'] ?? 'Event Tanpa Judul' }}
                                </option>
                            @empty
                                <option value="">Belum ada event</option>
                            @endforelse
                        </select>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 animate-fade-in shadow-sm w-full max-w-2xl mx-auto">
                    <span class="material-symbols-outlined text-emerald-500 text-2xl">task_alt</span>
                    <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="flex-1 bg-white rounded-[3rem] border border-slate-100 shadow-sm relative flex flex-col items-center justify-center p-12 overflow-hidden mb-8">
                
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-cyan-500 to-blue-500 rounded-full blur-[120px]"></div>
                </div>

                <div class="relative z-10 w-full max-w-2xl text-center">
                    
                    <div id="draw-display" class="bg-slate-50 rounded-[3rem] p-16 border-4 border-dashed border-slate-200 mb-12 transition-all duration-500">
                        
                        <div id="idle-state">
                            <span class="material-symbols-outlined text-8xl text-slate-200 mb-4 animate-bounce">casino</span>
                            <h3 class="text-2xl font-bold text-slate-400">Siap menemukan pemenang?</h3>
                            <p class="text-slate-400 text-sm mt-2">Hanya peserta yang <span class="font-bold text-emerald-500">Sudah Hadir</span> yang memenuhi syarat undian.</p>
                        </div>

                        <div id="winner-state" class="hidden flex flex-col items-center justify-center min-h-[160px]">
                            <span id="winner-badge" class="text-slate-400 font-black uppercase tracking-[0.3em] text-sm mb-4 block transition-colors">Mencari Pemenang...</span>
                            <h2 id="winner-name" class="text-4xl md:text-5xl font-black text-slate-900 mb-2 tracking-tight line-clamp-2">
                                {{ count($participants ?? []) > 0 ? 'MENGUNDI' : 'KOSONG' }}
                            </h2>
                            <p id="winner-id" class="text-xl font-mono text-slate-500 mt-2">#-----</p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-6">
                        @if(count($participants ?? []) > 0)
                            <button id="draw-btn" onclick="startDraw()" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-12 py-6 rounded-full font-black text-xl shadow-xl shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-4 mx-auto cursor-pointer border-none">
                                <span class="material-symbols-outlined text-3xl">celebration</span>
                                <span id="btn-text">MULAI UNDIAN</span>
                            </button>
                        @else
                            <button disabled class="bg-slate-200 text-slate-400 px-12 py-6 rounded-full font-black text-xl flex items-center gap-4 mx-auto cursor-not-allowed">
                                <span class="material-symbols-outlined text-3xl">block</span>
                                <span>BELUM ADA PESERTA</span>
                            </button>
                        @endif
                    </div>
                </div>

                <form id="save-winner-form" action="{{ url('/organizer/lucky_draw/winner') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $selectedEventId ?? '' }}">
                    <input type="hidden" name="participant_id" id="winning-participant-id">
                </form>

            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                <h3 class="text-sm font-black text-slate-900 mb-6 flex items-center gap-2 uppercase tracking-widest">
                    <span class="material-symbols-outlined text-amber-500">trophy</span> Riwayat Pemenang Acara Ini
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @forelse($winners ?? [] as $winner)
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4 animate-fade-in hover:border-amber-200 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <div class="overflow-hidden">
                                <p class="font-black text-slate-900 text-sm truncate">{{ $winner['participant_name'] ?? 'Unknown' }}</p>
                                <p class="text-[10px] text-slate-500 font-mono mt-0.5">#{{ $winner['booking_code'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-6 text-center text-slate-400">
                            <p class="text-xs font-bold uppercase tracking-widest">Belum ada peserta yang memenangkan undian ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <script>
            const participants = @json($participants ?? []);
            let isDrawing = false;

            function startDraw() {
                if (isDrawing || participants.length === 0) return;
                
                isDrawing = true;
                const drawDisplay = document.getElementById('draw-display');
                const idleState = document.getElementById('idle-state');
                const winnerState = document.getElementById('winner-state');
                const btnText = document.getElementById('btn-text');
                const drawBtn = document.getElementById('draw-btn');
                const winnerName = document.getElementById('winner-name');
                const winnerId = document.getElementById('winner-id');
                const winnerBadge = document.getElementById('winner-badge');

                // Transisi UI dari Idle ke Animasi Mengundi
                idleState.classList.add('hidden');
                winnerState.classList.remove('hidden');
                
                drawDisplay.classList.add('ring-4', 'ring-cyan-500', 'ring-offset-8');
                drawBtn.disabled = true;
                drawBtn.classList.add('opacity-80', 'cursor-not-allowed', 'animate-pulse');
                btnText.innerText = "MENGUNDI...";

                let counter = 0;
                const maxDuration = 3000; // 3 detik durasi total animasi
                const intervalTime = 50;  // Ganti nama tiap 50ms
                const maxTicks = maxDuration / intervalTime;

                // Animasi Pergantian Nama Acak
                const timer = setInterval(() => {
                    const randomIndex = Math.floor(Math.random() * participants.length);
                    winnerName.innerText = participants[randomIndex].name || 'Peserta';
                    winnerId.innerText = "#" + (participants[randomIndex].booking_code || '---');
                    counter++;

                    if (counter >= maxTicks) {
                        clearInterval(timer);
                        finalizeDraw(participants[randomIndex]);
                    }
                }, intervalTime);
            }

            function finalizeDraw(winner) {
                const drawDisplay = document.getElementById('draw-display');
                const btnText = document.getElementById('btn-text');
                const drawBtn = document.getElementById('draw-btn');
                const winnerBadge = document.getElementById('winner-badge');
                const winnerName = document.getElementById('winner-name');

                // Tampilan Pemenang Mutlak
                drawDisplay.classList.remove('border-dashed', 'bg-slate-50');
                drawDisplay.classList.add('bg-white', 'shadow-2xl', 'scale-[1.02]', 'border-cyan-500');
                
                winnerBadge.innerText = "SELAMAT KEPADA PEMENANG!";
                winnerBadge.classList.replace('text-slate-400', 'text-cyan-600');
                winnerName.classList.replace('text-slate-900', 'text-cyan-700');
                
                drawBtn.classList.remove('animate-pulse');
                btnText.innerText = "MENYIMPAN DATA...";

                // Set ID pemenang dan submit ke Database setelah 2 detik agar efek terbaca
                document.getElementById('winning-participant-id').value = winner.id;
                
                setTimeout(() => {
                    document.getElementById('save-winner-form').submit();
                }, 2000);
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