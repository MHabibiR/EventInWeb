<aside class="fixed w-72 h-screen bg-white border-r border-slate-100 flex flex-col transition-transform z-50">
    <div class="p-8 pb-6">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Event<span class="text-cyan-600">In</span></h1>
        
        <div class="mt-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center text-cyan-700 font-bold uppercase">
                {{ substr(session('user_data.name', 'U'), 0, 1) }}
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900">{{ session('user_data.name', 'Pengguna') }}</p>
                <p class="text-[10px] uppercase tracking-widest font-black text-slate-400">
                    {{ session('user_data.role') == 'main_admin' ? 'Main Admin' : 'Organizer' }}
                </p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        
        @if(session('user_data.role') === 'main_admin')
            <div class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-4">Menu Utama</div>
            
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/dashboard') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">dashboard</span>
                <span class="text-sm font-bold">Dashboard Admin</span>
            </a>

            <a href="{{ url('/admin/manage-events') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/manage-events*') || Request::is('admin/events*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">event_note</span>
                <span class="text-sm font-bold">Siklus Event</span>
            </a>

            <a href="{{ url('/admin/manage_organizer') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/manage_organizer') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">corporate_fare</span>
                <span class="text-sm font-bold">Manage Organizer</span>
            </a>

            <a href="{{ url('/admin/proposals') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/proposals') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">approval</span>
                <span class="text-sm font-bold">Proposal Event</span>
            </a>
        @endif

        @if(session('user_data.role') === 'organizer')
            <div class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-4">Operasional Acara</div>

            <a href="{{ url('/organizer/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('organizer/dashboard') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">monitoring</span>
                <span class="text-sm font-bold">Ringkasan</span>
            </a>

            <a href="{{ url('/organizer/peserta') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('organizer/peserta') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">groups</span>
                <span class="text-sm font-bold">Daftar Peserta</span>
            </a>

            <a href="{{ url('/organizer/checkin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('organizer/checkin') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">qr_code_scanner</span>
                <span class="text-sm font-bold">Gate Check-In</span>
            </a>

            <a href="{{ url('/organizer/seating') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('organizer/seating') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">chair</span>
                <span class="text-sm font-bold">Denah Kursi</span>
            </a>

            <a href="{{ url('/organizer/lucky_draw') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('organizer/lucky_draw') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">redeem</span>
                <span class="text-sm font-bold">Lucky Draw</span>
            </a>

            <a href="{{ url('/organizer/sertifikat') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('organizer/sertifikat') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-500 hover:bg-slate-50' }} transition-colors">
                <span class="material-symbols-outlined text-xl">workspace_premium</span>
                <span class="text-sm font-bold">E-Sertifikat</span>
            </a>
        @endif
    </nav>

    <div class="p-6 mt-auto border-t border-slate-100">
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center justify-center gap-3 w-full px-4 py-3 rounded-xl text-rose-500 bg-rose-50 hover:bg-rose-100 transition-colors">
                <span class="material-symbols-outlined text-xl">logout</span>
                <span class="text-sm font-bold">Keluar Akun</span>
            </button>
        </form>
    </div>
</aside>