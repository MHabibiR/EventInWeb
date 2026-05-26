@extends('layout.app')

@section('title', 'Pengaturan Profil')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50 font-inter">
        <div class="p-10 max-w-4xl mx-auto w-full">
            
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">
                    {{ session('user_data.role') === 'main_admin' ? 'Profil Eksekutif Admin' : 'Profil Penyelenggara' }}
                </h2>
                <p class="text-slate-500 mt-2 font-medium">
                    {{ session('user_data.role') === 'main_admin' ? 'Kelola kredensial keamanan akun kendali pusat sistem Anda.' : 'Kelola identitas resmi instansi Anda untuk kebutuhan branding sertifikat dan publikasi.' }}
                </p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->has('api_error'))
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                    <p class="text-sm font-bold text-rose-700">{{ $errors->first('api_error') }}</p>
                </div>
            @endif

            <form action="{{ url('/profile/update') }}" method="POST" class="space-y-8">
                @csrf
                
                <section class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-xs font-black text-slate-900 mb-8 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> 
                        {{ session('user_data.role') === 'main_admin' ? 'Foto Avatar Pengguna' : 'Foto & Branding Instansi' }}
                    </h3>
                    
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-[2rem] bg-slate-100 overflow-hidden border-4 border-white shadow-xl ring-1 ring-slate-200">
                                <img id="preview-logo" src="{{ asset('assets/MBG.jpg') }}" class="w-full h-full object-cover" alt="Avatar">
                            </div>
                        </div>
                        
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="font-bold text-slate-800 text-sm">Pas foto resmi akun</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm">Gunakan foto beresolusi tinggi dengan rasio persegi 1:1 untuk performa visual terbaik saat muncul di sertifikat.</p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-xs font-black text-slate-900 mb-2 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                                {{ session('user_data.role') === 'main_admin' ? 'Nama Lengkap Admin' : 'Nama Instansi / Organisasi' }}
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user['name'] ?? session('user_data.name')) }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Alamat Email Resmi</label>
                            <input type="email" name="email" value="{{ old('email', $user['email'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" required>
                        </div>

                        @if(session('user_data.role') === 'organizer')
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tipe Penyelenggara</label>
                                <select name="organization_type" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none cursor-pointer">
                                    <option value="Individu" {{ (old('organization_type', $user['organization_type'] ?? '') == 'Individu') ? 'selected' : '' }}>Individu / Perorangan</option>
                                    <option value="Lembaga" {{ (old('organization_type', $user['organization_type'] ?? '') == 'Lembaga') ? 'selected' : '' }}>Lembaga / Perusahaan / UKM</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone', $user['phone'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" placeholder="Contoh: 08123xxx">
                            </div>
                        @endif
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-xs font-black text-slate-900 mb-2 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Kredensial Keamanan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kata Sandi Baru</label>
                            <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" placeholder="Kosongkan jika tidak ingin diubah">
                        </div>
                    </div>
                </section>

                <div class="flex items-center justify-end gap-4 pb-12">
                    <button type="button" onclick="window.history.back()" class="px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">Batalkan</button>
                    <button type="submit" class="primary-gradient text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-all cursor-pointer">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
        <style>
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
        </style>
    </main>
@endsection