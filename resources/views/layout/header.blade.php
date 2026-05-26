<header class="ml-72 flex items-center justify-between h-20 px-8 sticky top-0 z-40 bg-white/70 backdrop-blur-xl border-b border-slate-100 font-headline">
    
    <div class="flex items-center gap-8 flex-1">
        <span class="text-lg font-black text-slate-900 uppercase tracking-wider hidden lg:block">Management Events</span>
        
        <div class="flex items-center bg-slate-100 px-4 py-2 rounded-full w-full max-w-md gap-3">
            <span class="material-symbols-outlined text-slate-400">search</span>
            <input type="text" class="bg-transparent border-none focus:outline-none text-sm w-full" placeholder="Cari event atau peserta...">
        </div>
    </div>

    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4 border-l border-slate-100 pl-6">
            
            <div class="relative group cursor-pointer">
                <button class="hover:text-cyan-500 relative flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-cyan-600 transition-colors">notifications</span>
                    <span id="notif-count" class="absolute top-0 right-0 w-3 h-3 bg-cyan-500 border-2 border-white rounded-full text-[0px] flex items-center justify-center text-white font-bold hidden">0</span>
                </button>
                
                <div class="absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-2xl border border-slate-100 p-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-900 mb-4 font-inter">Notifikasi Terbaru</h4>
                    <div id="notif-list" class="space-y-3 font-inter">
                        <p class="text-xs text-slate-400">Memuat notifikasi...</p>
                    </div>
                </div>
            </div>

            <div class="relative group cursor-pointer flex items-center gap-3">
                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white shadow-sm ring-1 ring-slate-200">
                    <img src="{{ asset('assets/MBG.jpg') }}" alt="User" class="w-full h-full object-cover">
                </div>
                
                <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 font-inter">
                    <div class="p-4 bg-slate-50/50 border-b border-slate-50">
                        <p class="text-xs font-black text-slate-900">{{ session('user_data.name', 'Studio Karawang') }}</p>
                        <p class="text-[9px] font-bold text-cyan-600 uppercase mt-0.5">
                            {{ session('user_data.role') == 'main_admin' ? 'Main Admin' : 'Organizer' }}
                        </p>
                    </div>
                    <a href="{{ url('/profile') }}" class="flex items-center gap-3 p-4 hover:bg-slate-50 text-slate-600 transition-colors">
                        <span class="material-symbols-outlined text-sm">person_edit</span>
                        <span class="text-xs font-bold">Edit Profil</span>
                    </a>
                    <hr class="border-slate-50">
                    <form action="{{ url('/logout') }}" method="POST" class="w-full m-0 p-0">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-4 hover:bg-rose-50 text-rose-500 transition-colors text-left cursor-pointer">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            <span class="text-xs font-bold">Keluar Sistem</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

<script>
const apiToken = "{{ session('api_token') }}";

async function fetchNotifications() {
    try {
        const response = await fetch('http://127.0.0.1:8001/api/notifications', {
            headers: { 'Authorization': 'Bearer ' + apiToken }
        });
        const data = await response.json();
        const list = document.getElementById('notif-list');
        const count = document.getElementById('notif-count');
        
        list.innerHTML = ''; 
        if (data.length > 0) {
            count.innerText = data.length;
            count.classList.remove('hidden');
            data.forEach(notif => {
                list.innerHTML += `
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-[10px] font-bold text-cyan-700 uppercase">${notif.type}</p>
                        <p class="text-[11px] text-slate-600 mt-1">${notif.message}</p>
                    </div>
                `;
            });
        } else {
            list.innerHTML = '<p class="text-xs text-slate-400">Tidak ada notifikasi baru.</p>';
        }
    } catch (err) {
        console.error('Gagal mengambil notifikasi:', err);
    }
}
fetchNotifications();
</script>