@extends('layout.app')

@section('title', 'Buat Event Baru')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
        <div class="p-12 max-w-6xl mx-auto w-full">
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Buat Event Baru</h2>
                <p class="text-slate-500 mt-2 font-medium">Atur detail Event arsitektur Anda yang akan datang.</p>
            </div>

            <form action="{{ url('/admin/events/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-12 gap-12">
                    <div class="col-span-12 lg:col-span-8 space-y-10">
                        <section class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-lg font-bold font-headline text-slate-900 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-cyan-600">info</span> Informasi Dasar
                            </h3>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-900 mb-2">Judul Event</label>
                                    <input type="text" name="title" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 transition-all font-bold text-slate-900" placeholder="Contoh: Puncak Urbanisme Berkelanjutan 2025"/>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-900 mb-2">Jenis Event</label>
                                        <select name="event_type" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-bold text-slate-700 focus:outline-none transition-all">
                                            <option value="Konferensi">Konferensi</option>
                                            <option value="Workshop">Workshop</option>
                                            <option value="Pameran">Pameran</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-900 mb-2">Kapasitas Diharapkan</label>
                                        <input type="number" name="total_capacity" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-bold text-slate-900" placeholder="Contoh: 500" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-900 mb-2">Deskripsi Event</label>
                                    <textarea name="description" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 h-32 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 transition-all" placeholder="Berikan deskripsi rinci tentang Event, termasuk tema utama, pembicara, dan aktivitas."></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-lg font-bold font-headline text-slate-900 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-cyan-600">location_on</span> Tanggal & Lokasi
                            </h3>
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="date-start" class="block text-sm font-bold text-slate-900 mb-2">Mulai dari</label>
                                    <input type="date" name="date_start" id="date-start" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                                </div>
                                <div>
                                    <label for="date-end" class="block text-sm font-bold text-slate-900 mb-2">Berakhir pada</label>
                                    <input type="date" name="date_end" id="date-end" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Nama Tempat</label>
                                <input type="text" name="venue_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-bold text-slate-900" placeholder="Contoh: Convention Hall">
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-bold text-slate-900 mb-2">Alamat Tempat</label>
                                <input type="text" name="venue_address" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3" placeholder="Jalan, Kota, Provinsi, Kode Pos">
                            </div>
                        </section>

                        <section class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-8">
                                <h3 class="text-lg font-bold font-headline text-slate-900 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-cyan-600">confirmation_number</span> Kategori & Slot Tiket
                                </h3>
                                <button type="button" onclick="addCategory()" class="text-xs font-black text-cyan-600 bg-cyan-50 px-4 py-2 rounded-xl hover:bg-cyan-100 transition-colors uppercase tracking-widest">
                                    + Tambah Kategori
                                </button>
                            </div>

                            <div id="category-list" class="space-y-4">
                                <div class="grid grid-cols-12 gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100 relative group">
                                    <div class="col-span-6">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Nama Kategori</label>
                                        <input type="text" name="category_names[]" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-900" value="VIP">
                                    </div>
                                    <div class="col-span-4">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Jumlah Slot</label>
                                        <input type="number" name="category_slots[]" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-900" value="50">
                                    </div>
                                    <div class="col-span-2 flex items-end">
                                        <button type="button" class="w-full h-[46px] flex items-center justify-center text-rose-400 hover:text-rose-600 transition-colors">
                                            <span class="material-symbols-outlined">delete_sweep</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-span-12 lg:col-span-4 space-y-8">
                        <section class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-widest">Sampul Event</h3>
                            
                            <label for="cover-upload" class="border-2 border-dashed border-slate-200 rounded-xl h-48 flex flex-col items-center justify-center text-slate-400 hover:bg-slate-50 hover:border-cyan-200 cursor-pointer transition-all group mb-6 block w-full">
                                <span class="material-symbols-outlined text-4xl mb-2 group-hover:scale-110 transition-transform">add_photo_alternate</span>
                                <span class="text-xs font-bold uppercase tracking-widest">Klik untuk unggah</span>
                                <input type="file" id="cover-upload" name="cover_image" class="hidden" accept="image/*">
                            </label>

                            <div class="space-y-4">
                                <div>
                                    <label for="ticketing" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jenis Tiket Utama</label>
                                    <select id="ticketing" name="ticket_type" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-bold text-slate-700 focus:outline-none transition-all">
                                        <option value="Gratis">Gratis</option>
                                        <option value="Berbayar">Berbayar</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="base-price" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Harga Dasar</label>
                                    <input type="number" name="base_price" id="base-price" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-bold text-slate-900" placeholder="Contoh: 25000">
                                </div>
                            </div>
                        </section>
                        
                        <div class="flex flex-col gap-3">
                            <button type="submit" name="action" value="draft" class="w-full py-4 rounded-xl font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all text-xs uppercase tracking-widest">
                                Simpan Draf
                            </button>
                            <button type="submit" name="action" value="publish" class="w-full py-4 rounded-xl font-bold text-white primary-gradient shadow-xl shadow-cyan-500/30 active:scale-95 transition-all text-xs uppercase tracking-widest">
                                Terbitkan Event
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        function addCategory() {
            const list = document.getElementById('category-list');
            const newItem = document.createElement('div');
            newItem.className = "grid grid-cols-12 gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100 animate-fade-in relative group";
            
            // Perhatikan penambahan name array pada script ini
            newItem.innerHTML = `
                <div class="col-span-6">
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Nama Kategori</label>
                    <input type="text" name="category_names[]" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-900" placeholder="Contoh: Reguler">
                </div>
                <div class="col-span-4">
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Jumlah Slot</label>
                    <input type="number" name="category_slots[]" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-900" placeholder="0">
                </div>
                <div class="col-span-2 flex items-end">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="w-full h-[46px] flex items-center justify-center text-rose-400 hover:text-rose-600 transition-colors">
                        <span class="material-symbols-outlined">delete_sweep</span>
                    </button>
                </div>
            `;
            list.appendChild(newItem);
        }
    </script>

    <style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
    
    /* Utility class for the primary gradient based on your design */
    .primary-gradient {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
    }
    </style>
@endsection