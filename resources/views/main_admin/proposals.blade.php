<@extends('layout.app')

@section('title', 'Proposals')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Proposal Event</h2>
                <p class="text-slate-500 mt-2 font-medium">Tinjau dan kelola submission Event dari pengguna mobile.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Menunggu Tinjauan</div>
                    <div class="text-3xl font-black text-amber-600">12</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Disetujui</div>
                    <div class="text-3xl font-black text-emerald-600">45</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Ditolak</div>
                    <div class="text-3xl font-black text-rose-600">3</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-xs uppercase tracking-wider text-slate-400 font-bold">
                                <th class="p-4 pl-6">Proposal Event</th>
                                <th class="p-4">Status Biaya</th> <th class="p-4">Penyusun</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 pr-6 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 pl-6">
                                    <div class="font-bold text-slate-900">Tech Innovation Seminar 2027</div>
                                    <div class="text-xs text-cyan-600 font-medium">Kategori: Seminar</div>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900">Berbayar</span>
                                        <span class="text-xs text-slate-500">Rp 50.000</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <img src="../assets/MBG.jpg" class="w-8 h-8 rounded-full">
                                        <div>
                                            <div class="font-medium">K.Juun</div>
                                            <div class="text-xs text-slate-400 text-[10px]">18 April 2026</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-600 text-[10px] font-black rounded-md uppercase\">Menunggu</span>
                                </td>
                                <td class="p-4 pr-6 text-right space-x-2">
                                    <button class="p-2 hover:bg-emerald-50 text-emerald-600 rounded-lg transition-colors" title="Setujui">
                                        <span class="material-symbols-outlined text-xl">check_circle</span>
                                    </button>
                                    <button class="p-2 hover:bg-rose-50 text-rose-600 rounded-lg transition-colors" title="Tolak">
                                        <span class="material-symbols-outlined text-xl">cancel</span>
                                    </button>
                                    <button onclick="openModal()" class="p-2 hover:bg-slate-100 text-slate-400 rounded-lg transition-colors" title="Lihat Detail Proposal">
                                        <span class="material-symbols-outlined text-xl">visibility</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="proposalModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
                    
                    <div class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-2xl overflow-hidden">
                        <div class="primary-gradient p-8 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Detail Spesifikasi Event</span>
                                    <h3 class="text-2xl font-black font-headline mt-1">Tech Innovation Seminar 2027</h3>
                                </div>
                                <button onclick="closeModal()" class="hover:rotate-90 transition-transform">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>
                        </div>

                        <div class="p-8 space-y-6">
                            <div class="grid grid-cols-2 gap-x-6 gap-y-8">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kategori</label>
                                    <p class="font-bold text-slate-900 mt-1">Seminar / Workshop</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Status Biaya</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-2 py-0.5 bg-cyan-100 text-cyan-700 text-[10px] font-black rounded-md uppercase">Paid Event</span>
                                        <p class="font-bold text-slate-900">Rp 50.000</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kapasitas Peserta</label>
                                    <p class="font-bold text-slate-900 mt-1">500 Orang</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pelaksanaan Event</label>
                                    <p class="font-bold text-slate-900 mt-1">12 Oktober 2027</p>
                                </div>
                                <div class="col-span-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Lokasi</label>
                                    <p class="font-bold text-slate-900 mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm text-cyan-600">location_on</span>
                                        Convention Hall, Karawang
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Deskripsi Event</label>
                                <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                                    Event ini bertujuan untuk memperkenalkan teknologi AI terkini kepada mahasiswa dan profesional di Karawang dengan sesi hands-on.
                                </p>
                            </div>

                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-cyan-600">picture_as_pdf</span>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Proposal_Tech2027.pdf</p>
                                        <p class="text-[10px] text-slate-400">2.4 MB • Dimuat naik 2 jam lepas</p>
                                    </div>
                                </div>
                                <button class="text-cyan-600 font-bold text-xs hover:underline">LIHAT FILE</button>
                            </div>
                        </div>

                        <div class="p-8 pt-0 flex gap-4">
                            <button class="flex-1 py-4 rounded-2xl font-bold bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors">APPROVE SEKARANG</button>
                            <button class="flex-1 py-4 rounded-2xl font-bold bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors">TOLAK PERMOHONAN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function openModal() { 
            document.getElementById('proposalModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal() { 
            document.getElementById('proposalModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection