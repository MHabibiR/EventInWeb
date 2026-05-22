@extends('layout.app')

@section('title', 'Sertifikat')

@section('content')
    <main class="ml-72 min-h-screen flex bg-slate-50">
        <div class="w-96 bg-white border-r border-slate-100 flex flex-col shadow-sm sticky top-20 h-[calc(100vh-5rem)]">
            <div class="p-6 border-b bg-slate-50/50">
                <h3 class="font-black text-slate-900 tracking-tight">Mesin Sertifikat</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Konfigurasi & Buat</p>
            </div>
            
            <div class="flex-1 p-6 space-y-8 overflow-y-auto">
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Nama Event</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
                        <option>Architecture Design Summit 2024</option>
                        <option>Future Cities Initiative</option>
                    </select>
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Template Desain</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="p-3 border-2 border-cyan-600 rounded-xl bg-cyan-50 text-cyan-700 text-xs font-bold">Minimalis Modern</button>
                        <button class="p-3 border-2 border-slate-100 rounded-xl text-slate-400 text-xs font-bold hover:bg-slate-50 transition-colors">Serif Klasik</button>
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Isi Otomatis Kolom</label>
                    <div class="space-y-2">
                        <div class="p-3 bg-white border border-slate-200 rounded-xl text-xs font-medium flex justify-between items-center group">
                            <span class="text-slate-600">{{ Nama Peserta }}</span>
                            <span class="material-symbols-outlined text-sm text-slate-300 group-hover:text-cyan-500 transition-colors">check_circle</span>
                        </div>
                        <div class="p-3 bg-white border border-slate-200 rounded-xl text-xs font-medium flex justify-between items-center group">
                            <span class="text-slate-600">{{ Nama Event }}</span>
                            <span class="material-symbols-outlined text-sm text-slate-300 group-hover:text-cyan-500 transition-colors">check_circle</span>
                        </div>
                        <div class="p-3 bg-white border border-slate-200 rounded-xl text-xs font-medium flex justify-between items-center group">
                            <span class="text-slate-600">{{ Verification QR }}</span>
                            <span class="material-symbols-outlined text-sm text-cyan-500">verified</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t bg-slate-50/30">
                <button class="w-full primary-gradient text-white py-4 rounded-2xl font-black text-sm shadow-xl shadow-cyan-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">auto_awesome</span>
                    Buat untuk Semua Peserta
                </button>
                <p class="text-[9px] text-center text-slate-400 font-bold uppercase mt-4 tracking-tighter">
                    Akan dikirim otomatis ke aplikasi mobile peserta
                </p>
            </div>
        </div>

        <div class="flex-1 bg-slate-100 flex items-start justify-center p-12 overflow-auto shadow-[inset_0_2px_10px_rgba(0,0,0,0.05)]">
            <div class="flex flex-col items-center gap-8 w-full">
                <div class="w-full max-w-5xl flex justify-between items-center">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                        Preview Desain Sertifikat
                    </h4>
                    <div class="flex gap-2">
                        <button class="p-2 bg-white rounded-lg border border-slate-200 text-slate-400 hover:text-cyan-600 transition-colors">
                            <span class="material-symbols-outlined text-sm">zoom_in</span>
                        </button>
                        <button class="p-2 bg-white rounded-lg border border-slate-200 text-slate-400 hover:text-cyan-600 transition-colors">
                            <span class="material-symbols-outlined text-sm">zoom_out</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white w-full max-w-4xl aspect-[1.414/1] shadow-2xl relative flex overflow-hidden rounded-sm border border-slate-100">
                    <div class="w-40 h-full primary-gradient flex flex-col items-center justify-between py-12 text-white/20">
                        <span class="material-symbols-outlined text-6xl">architecture</span>
                        <div class="rotate-90 origin-center whitespace-nowrap font-black tracking-[1em] text-[10px] uppercase">
                            Tersertifikasi Verifikasi
                        </div>
                        <span class="material-symbols-outlined text-6xl opacity-20">verified_user</span>
                    </div>
                    
                    <div class="flex-1 p-20 flex flex-col justify-between">
                        <div>
                            <div class="text-cyan-700 font-black uppercase tracking-[0.4em] text-[10px] mb-12">Certificate of Attendance</div>
                            <h1 class="text-6xl font-black text-slate-900 mb-4 tracking-tight">Kim Juun</h1>
                            <p class="text-slate-500 text-xl font-medium leading-relaxed">
                                Telah terverifikasi sebagai <span class="text-slate-900 font-bold">MBG ( My Bini Gw ) + ( My Beautiful Girl )</span>
                                Sejak dilahirkan. Karawang, 20 April 2026.
                            </p>
                        </div>

                        <div class="flex items-end justify-between border-t border-slate-100 pt-12">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Date Issued</p>
                                    <p class="font-bold text-slate-900">April 19, 2026</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Verification ID</p>
                                    <p class="font-mono text-sm text-cyan-700 font-bold">CERT-2024-ADS-09122</p>
                                </div>
                            </div>

                            <div class="flex flex-col items-center gap-2">
                                <div class="w-24 h-24 bg-slate-50 border-2 border-slate-100 rounded-xl flex items-center justify-center p-2 relative group cursor-help">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=VALID-CERT-09122" alt="Verification QR" class="w-full h-full opacity-80 group-hover:opacity-100 transition-opacity">
                                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center shadow-lg">
                                        <span class="material-symbols-outlined text-[14px] text-white font-bold">check</span>
                                    </div>
                                </div>
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Scan to Verify</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection