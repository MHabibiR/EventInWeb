@extends('layout.app')

@section('title', 'Seating Management')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="px-8 py-4 border-b border-slate-100 bg-white flex items-center justify-between sticky top-20 z-30">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Manajemen Tempat Duduk</h2>
                <p class="text-[10px] font-black text-cyan-600 uppercase tracking-widest">
                    Acara: Architecture Design Summit 2024
                </p>
            </div>
            <div class="flex items-center gap-3">
                <select class="bg-slate-100 text-slate-600 px-3 py-2 rounded-lg font-bold text-xs focus:outline-none border-none">
                    <option>Aula Utama</option>
                    <option>Ballroom VIP</option>
                </select>
                <button class="primary-gradient text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md shadow-cyan-500/20">
                    Simpan Tata Letak
                </button>
            </div>
        </div>
        
        <div class="flex-1 flex overflow-hidden relative">
            <div id="visual-area" class="flex-1 p-12 flex flex-col items-center justify-center relative overflow-auto transition-all duration-500 ease-in-out">
                
                <div class="flex gap-6 mb-12 bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-md bg-emerald-500"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Tersedia</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-md bg-rose-500"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Sudah Dipesan</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-md bg-amber-500"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Area VIP</span>
                    </div>
                </div>

                <div class="w-full max-w-2xl h-12 bg-slate-200 rounded-t-[3rem] border-b-8 border-slate-300 flex items-center justify-center mb-24 relative">
                    <span class="font-black text-slate-400 uppercase text-xs tracking-[0.3em]">Area Panggung / Layar</span>
                    <div class="absolute -bottom-16 w-full h-8 bg-gradient-to-b from-slate-200/50 to-transparent"></div>
                </div>
                
                <div class="grid gap-8">
                    <div class="flex gap-3">
                        <span class="w-6 text-xs font-black text-slate-300 flex items-center">A</span>
                        <?php for($i=1; $i<=8; $i++): ?>
                            <div onclick="viewSeat('A<?= $i ?>', 'VIP')" class="w-10 h-10 rounded-t-xl rounded-b-md bg-amber-500 cursor-pointer hover:scale-110 transition-all flex items-center justify-center text-[10px] font-bold text-white shadow-sm shadow-amber-500/20">A<?= $i ?></div>
                        <?php endfor; ?>
                    </div>
                    
                    <div class="flex gap-3">
                        <span class="w-6 text-xs font-black text-slate-300 flex items-center">B</span>
                        <?php for($i=1; $i<=10; $i++): ?>
                            <?php $isBooked = in_array($i, [3, 4, 7]); ?>
                            <div onclick="viewSeat('B<?= $i ?>', 'Regular', <?= $isBooked ? 'true' : 'false' ?>)" 
                                class="w-10 h-10 rounded-t-xl rounded-b-md <?= $isBooked ? 'bg-rose-500' : 'bg-emerald-500' ?> cursor-pointer hover:scale-110 transition-all flex items-center justify-center text-[10px] font-bold text-white shadow-sm">B<?= $i ?></div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div id="seat-detail" class="fixed right-0 top-20 bottom-0 w-80 bg-white border-l border-slate-100 p-8 transform translate-x-full transition-transform duration-500 ease-in-out shadow-2xl z-50">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Detail Kursi</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Informasi Real-time</p>
                    </div>
                    <button onclick="closeDetail()" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <span class="material-symbols-outlined text-xl">close</span>
                    </button>
                </div>

                <div id="seat-info" class="space-y-6">
                    <div class="text-center p-8 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <span class="material-symbols-outlined text-4xl text-slate-200 mb-2">touch_app</span>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pilih kursi untuk melihat detail peserta</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    function viewSeat(id, category, isBooked = false) {
        const detailPanel = document.getElementById('seat-detail');
        const visualArea = document.getElementById('visual-area');
        const infoContainer = document.getElementById('seat-info');
        
        detailPanel.classList.remove('translate-x-full');
        
        visualArea.style.marginRight = "320px";
        
        /* Informasi */
        if(isBooked) {
            infoContainer.innerHTML = `
                <div class="bg-rose-50 p-6 rounded-3xl border border-rose-100 animate-fade-in">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-rose-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest">Sudah Dipesan</span>
                        <span class="text-2xl font-black text-slate-900">${id}</span>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-rose-200/50">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Peserta</label>
                            <p class="font-bold text-slate-900">K.Juun</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ticket ID</label>
                            <p class="font-mono text-sm text-slate-600">#MBG-2211</p>
                        </div>
                    </div>
                </div>
                <button class="w-full py-4 text-xs font-black text-rose-600 bg-rose-50 rounded-2xl hover:bg-rose-100 transition-colors uppercase tracking-widest border border-rose-200">Hapus Pemesanan</button>
            `;
        } else {
            infoContainer.innerHTML = `
                <div class="bg-emerald-50 p-6 rounded-3xl border border-emerald-100 animate-fade-in">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-emerald-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest">Tersedia</span>
                        <span class="text-2xl font-black text-slate-900">${id}</span>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
                        Kursi ini tersedia di area kategori <span class="text-emerald-700">${category}</span>.
                    </p>
                </div>
                <button class="w-full py-4 text-xs font-black text-white primary-gradient rounded-2xl shadow-lg shadow-cyan-500/20 uppercase tracking-widest">Daftarkan peserta</button>
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
@endsection