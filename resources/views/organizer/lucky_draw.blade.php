@extends('layout.app')

@section('title', 'Lucky Draw')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col">
        <div class="p-8 max-w-[1400px] mx-auto w-full h-full flex flex-col">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-black text-slate-900">Mesin Undian Berhadiah</h2>
                    <p class="text-slate-500">Pilih pemenang secara acak dari peserta yang sudah hadir.</p>
                </div>
                <div class="w-72">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Acara Aktif</label>
                    <select class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-cyan-500/50">
                        <option>Architecture Design Summit 2024</option>
                        <option>Future Cities Initiative</option>
                    </select>
                </div>
            </div>

            <div class="flex-1 bg-white rounded-3xl border border-slate-100 shadow-sm relative flex flex-col items-center justify-center p-12 overflow-hidden">
                <div class="absolute inset-0 opacity-5 pointer-events-none">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] primary-gradient rounded-full blur-[100px]"></div>
                </div>

                <div class="relative z-10 w-full max-w-2xl text-center">
                    <div id="draw-display" class="bg-slate-50 rounded-[3rem] p-16 border-4 border-dashed border-slate-200 mb-12 transition-all duration-500">
                        <div id="idle-state">
                            <span class="material-symbols-outlined text-8xl text-slate-200 mb-4 animate-bounce">casino</span>
                            <h3 class="text-2xl font-bold text-slate-400">Siap menemukan pemenang?</h3>
                            <p class="text-slate-400 text-sm mt-2">Hanya peserta yang "Sudah Hadir" yang memenuhi syarat</p>
                        </div>

                        <div id="winner-state" class="hidden">
                            <span class="text-cyan-600 font-black uppercase tracking-[0.3em] text-sm mb-4 block">Selamat!</span>
                            <h2 id="winner-name" class="text-5xl font-black text-slate-900 mb-2 tracking-tight">Kim Juun</h2>
                            <p id="winner-id" class="text-xl font-mono text-slate-500">#MBG-2211</p>
                            <div class="mt-8 flex justify-center gap-2">
                                <span class="px-4 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase">Telah terpilih menjadi my bini</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-6">
                        <button id="draw-btn" onclick="startDraw()" class="primary-gradient text-white px-12 py-6 rounded-full font-black text-2xl shadow-2xl hover:scale-105 active:scale-95 transition-all flex items-center gap-4 mx-auto">
                            <span class="material-symbols-outlined text-4xl">celebration</span>
                            <span id="btn-text">MULAI UNDIAN</span>
                        </button>
                        
                        <button onclick="resetDraw()" class="text-slate-400 font-bold text-sm hover:text-slate-600 transition-colors">Reset Undian</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    function startDraw() {
        const drawDisplay = document.getElementById('draw-display');
        const idleState = document.getElementById('idle-state');
        const winnerState = document.getElementById('winner-state');
        const btnText = document.getElementById('btn-text');
        const drawBtn = document.getElementById('draw-btn');

        /* Animasi Loading/Spinning */
        btnText.innerText = "DRAWING...";
        drawBtn.disabled = true;
        drawBtn.classList.add('opacity-50', 'cursor-not-allowed');
        drawDisplay.classList.add('ring-4', 'ring-cyan-500', 'ring-offset-8');
        
        /* Simulasi pengambilan data acak dari backend */
        setTimeout(() => {
            idleState.classList.add('hidden');
            winnerState.classList.remove('hidden');
            
            drawDisplay.classList.remove('border-dashed', 'bg-slate-50');
            drawDisplay.classList.add('bg-white', 'shadow-2xl', 'scale-110', 'border-cyan-500');
            
            btnText.innerText = "UNDIAN LAGI";
            drawBtn.disabled = false;
            drawBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }, 3000); 
    }

    function resetDraw() {
        location.reload();
    }
    </script>
@endsection