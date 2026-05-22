@extends('layout.app')

@section('title', 'Profil Penyelenggara')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-10 max-w-4xl mx-auto w-full">
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Profil Penyelenggara</h2>
                <p class="text-slate-500 mt-2 font-medium">Kelola identitas resmi instansi Anda untuk kebutuhan branding sertifikat dan publikasi.</p>
            </div>

            <form action="#" method="POST" class="space-y-8">
                <section class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-xs font-black text-slate-900 mb-8 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Foto & Branding Instansi
                    </h3>
                    
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-[2rem] bg-slate-100 overflow-hidden border-4 border-white shadow-xl">
                                <img id="preview-logo" src="assets/MBG.jpg" class="w-full h-full object-cover">
                            </div>
                            <label for="logo-upload" class="absolute -bottom-2 -right-2 w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center cursor-pointer hover:scale-110 transition-all shadow-lg">
                                <span class="material-symbols-outlined text-sm">photo_camera</span>
                                <input type="file" id="logo-upload" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </label>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="font-bold text-slate-900">Logo Resmi Instansi</h4>
                            <p class="text-xs text-slate-400 mt-1 leading-relaxed">
                                Gunakan gambar format PNG transparan untuk hasil terbaik pada sertifikat digital. Maksimal 2MB.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-xs font-black text-slate-900 mb-2 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Informasi Identitas
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Instansi / Penyelenggara</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all" value="Studio Arsitektur Karawang">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tipe Organisasi</label>
                            <select class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-700 outline-none">
                                <option>Perusahaan / Startup</option>
                                <option>Instansi Pendidikan</option>
                                <option>Komunitas / Organisasi</option>
                                <option>Individu</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Alamat Kantor Resmi</label>
                            <textarea class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all h-24">Jl. Galuh Mas Raya, Telukjambe Timur, Karawang, Jawa Barat 41361</textarea>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-xs font-black text-slate-900 mb-2 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-cyan-500 rounded-full"></span> Kontak & Keamanan Akun
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Resmi (Login)</label>
                            <input type="email" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-400 cursor-not-allowed" value="admin@arc-karawang.com" disabled>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nomor WhatsApp PIC</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" value="081234567890">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Password Baru</label>
                            <input type="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Konfirmasi Password</label>
                            <input type="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:ring-2 focus:ring-cyan-500/20 outline-none" placeholder="••••••••">
                        </div>
                    </div>
                </section>

                <div class="flex items-center justify-end gap-4 pb-12">
                    <button type="button" class="px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Batalkan</button>
                    <button type="submit" class="primary-gradient text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-all">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-logo');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection