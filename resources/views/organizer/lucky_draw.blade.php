@extends('layout.app')

@section('title', 'Lucky Draw Event')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-900">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-3xl font-black font-headline text-white tracking-tight">Lucky Draw</h2>
                    <p class="text-slate-400 mt-2 font-medium">Undi pemenang hadiah dari daftar peserta yang telah hadir di lokasi.</p>
                </div>
                
                <div class="bg-slate-800 p-3 rounded-2xl border border-slate-700 min-w-[280px]">
                    <form action="{{ url('/organizer/lucky_draw') }}" method="GET" id="event-filter-form">
                        <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1 pl-1">Pilih Acara</label>
                        <select name="event_id" onchange="document.getElementById('event-filter-form').submit()" class="w-full bg-transparent font-bold text-white focus:outline-none text-sm cursor-pointer">
                            @foreach($events as $event)
                                <option value="{{ $event['id'] }}" {{ $selectedEventId == $event['id'] ? 'selected' : '' }} class="text-slate-900">
                                    {{ $event['title'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                
                <div class="col-span-12 lg:col-span-8 flex flex-col items-center justify-center bg-slate-800 rounded-[3rem] border border-slate-700 shadow-2xl p-16 relative overflow-hidden">
                    
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-cyan-500 to-transparent opacity-50"></div>
                    <div class="absolute -top-32 -right-32 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>

                    @if(session('success'))
                        <div class="absolute top-8 p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/50 flex items-center gap-3 animate-fade-in z-20">
                            <span class="material-symbols-outlined text-emerald-400">task_alt</span>
                            <p class="text-sm font-bold text-emerald-300">{{ session('success') }}</p>
                        </div>
                    @endif

                    <h3 class="text-slate-400 font-black uppercase tracking-[0.5em] text-sm mb-10 z-10">Sistem Undian Acara</h3>

                    <div class="w-full max-w-2xl h-48 bg-slate-900 rounded-3xl border-2 border-slate-700 flex flex-col items-center justify-center mb-12 relative z-10 shadow-inner">
                        <p id="winner-name" class="text-5xl md:text-6xl font-black text-white text-center tracking-tight transition-all px-4 truncate w-full">
                            {{ count($participants) > 0 ? 'SIAP DIUNDI' : 'TIDAK ADA PESERTA' }}
                        </p>
                        <p id="winner-ticket" class="text-cyan-400 font-mono mt-4 tracking-widest font-bold opacity-0 transition-opacity">
                            KODE-TIKET
                        </p>
                    </div>

                    <div class="relative z-10">
                        @if(count($participants) > 0)
                            <button id="draw-btn" onclick="startDraw()" class="px-12 py-5 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white font-black text-xl rounded-full uppercase tracking-widest shadow-[0_0_40px_-10px_rgba(6,182,212,0.8)] hover:scale-105 transition-all">
                                PUTAR UNDIAN
                            </button>
                        @else
                            <button disabled class="px-12 py-5 bg-slate-700 text-slate-500 font-black text-xl rounded-full uppercase tracking-widest cursor-not-allowed">
                                BELUM ADA PESERTA HADIR
                            </button>
                        @endif
                    </div>

                    <form id="save-winner-form" action="{{ url('/organizer/lucky_draw/winner') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $selectedEventId }}">
                        <input type="hidden" name="participant_id" id="winning-participant-id">
                    </form>

                </div>

                <div class="col-span-12 lg:col-span-4 flex flex-col">
                    <div class="bg-slate-800 rounded-[2.5rem] border border-slate-700 flex-1 flex flex-col overflow-hidden">
                        <div class="p-8 border-b border-slate-700 bg-slate-800/50">
                            <h3 class="text-lg font-black text-white flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-400">trophy</span> Daftar Pemenang
                            </h3>
                        </div>
                        <div class="p-6 overflow-y-auto flex-1 space-y-4">
                            @forelse($winners as $winner)
                                <div class="p-4 bg-slate-900 rounded-2xl border border-slate-700 flex items-center gap-4 animate-fade-in">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-lg">
                                        <span class="material-symbols-outlined text-xl">star</span>
                                    </div>
                                    <div>
                                        <p class="font-black text-white text-sm">{{ $winner['participant_name'] }}</p>
                                        <p class="text-xs text-slate-400 font-mono mt-1">{{ $winner['booking_code'] }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 text-slate-500">
                                    <span class="material-symbols-outlined text-4xl mb-2 opacity-50">auto_awesome</span>
                                    <p class="text-xs font-bold uppercase tracking-widest">Belum ada pemenang</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        const participants = @json($participants);
        let isDrawing = false;

        function startDraw() {
            if (isDrawing || participants.length === 0) return;
            
            isDrawing = true;
            const drawBtn = document.getElementById('draw-btn');
            const nameDisplay = document.getElementById('winner-name');
            const ticketDisplay = document.getElementById('winner-ticket');
            
            drawBtn.innerText = 'MENGUNDI...';
            drawBtn.classList.add('animate-pulse', 'opacity-80');
            ticketDisplay.style.opacity = 0;

            let counter = 0;
            const maxDuration = 3000; 
            const intervalTime = 50; 
            const maxTicks = maxDuration / intervalTime;

            // Efek putaran nama
            const timer = setInterval(() => {
                const randomIndex = Math.floor(Math.random() * participants.length);
                nameDisplay.innerText = participants[randomIndex].name;
                counter++;

                if (counter >= maxTicks) {
                    clearInterval(timer);
                    finalizeDraw();
                }
            }, intervalTime);
        }

        function finalizeDraw() {
            const winningIndex = Math.floor(Math.random() * participants.length);
            const winner = participants[winningIndex];

            /* Tampilkan pemenang di layar */
            const nameDisplay = document.getElementById('winner-name');
            const ticketDisplay = document.getElementById('winner-ticket');
            const drawBtn = document.getElementById('draw-btn');

            nameDisplay.innerText = winner.name;
            nameDisplay.classList.add('text-amber-400', 'scale-110'); 
            
            ticketDisplay.innerText = winner.booking_code;
            ticketDisplay.style.opacity = 1;

            drawBtn.innerText = 'MENYIMPAN...';
            drawBtn.classList.remove('animate-pulse');

            // Set ID pemenang ke form tersembunyi lalu Submit otomatis
            document.getElementById('winning-participant-id').value = winner.id;
            
            // Jeda 2 detik agar user bisa melihat pemenangnya sebelum reload
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
@endsection