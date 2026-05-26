<aside class="h-screen w-72 flex flex-col fixed left-0 top-0 bg-slate-50 shadow-[inset_-1px_0_0_0_rgba(0,0,0,0.05)] font-headline z-50">
    <div class="flex flex-col h-full py-8 px-6">
        
        <div class="mb-10 flex items-center gap-3">
            <div class="w-10 h-10 primary-gradient rounded-xl flex items-center justify-center text-white">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">architecture</span>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-900">Event<span class="text-cyan-600">In</span></h1>
                <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">
                    {{ session('user_data.role') == 'main_admin' ? 'Main Admin' : 'Manajemen Event' }}
                </p>
            </div>
        </div>

        <nav class="flex-1 space-y-2 overflow-y-auto font-inter">
            @if(session('user_data.role') === 'main_admin')
                <div class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-4">Menu Utama</div>
                
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/dashboard') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span class="font-medium text-sm">Dashboard Admin</span>
                </a>

                <a href="{{ url('/admin/manage-events') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/manage-events*') || Request::is('admin/events*') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">event_note</span>
                    <span class="font-medium text-sm">Siklus Event</span>
                </a>

                <a href="{{ url('/admin/manage_organizer') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/manage_organizer') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">corporate_fare</span>
                    <span class="font-medium text-sm">Manage Organizer</span>
                </a>

                <a href="{{ url('/admin/proposals') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/proposals') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">approval</span>
                    <span class="font-medium text-sm">Proposal Event</span>
                </a>
            @endif

            @if(session('user_data.role') === 'organizer')
                <div class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-4">Operasional Acara</div>

                <a href="{{ url('/organizer/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('organizer/dashboard') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">monitoring</span>
                    <span class="font-medium text-sm">Ringkasan</span>
                </a>

                <a href="{{ url('/organizer/peserta') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('organizer/peserta') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">groups</span>
                    <span class="font-medium text-sm">Daftar Peserta</span>
                </a>

                <a href="{{ url('/organizer/checkin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('organizer/checkin') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">qr_code_scanner</span>
                    <span class="font-medium text-sm">Gate Check-In</span>
                </a>

                <a href="{{ url('/organizer/seating') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('organizer/seating') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">chair</span>
                    <span class="font-medium text-sm">Denah Kursi</span>
                </a>

                <a href="{{ url('/organizer/lucky_draw') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('organizer/lucky_draw') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">redeem</span>
                    <span class="font-medium text-sm">Lucky Draw</span>
                </a>

                <a href="{{ url('/organizer/sertifikat') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('organizer/sertifikat') ? 'active-link-custom' : 'text-slate-500 hover:bg-slate-200/50' }}">
                    <span class="material-symbols-outlined text-xl">workspace_premium</span>
                    <span class="font-medium text-sm">E-Sertifikat</span>
                </a>
            @endif
        </nav>

        <div class="mt-8 font-inter">
            @if(session('user_data.role') === 'main_admin')
                <a href="{{ url('/admin/events/create') }}" class="primary-gradient text-white py-4 px-6 rounded-2xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-cyan-500/20 active:scale-95 transition-all w-full mb-4">
                    <span class="material-symbols-outlined">add_circle</span>
                    <span class="text-sm">Buat Event Baru</span>
                </a>
            @endif
            
            <form action="{{ url('/logout') }}" method="POST" class="m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-3 w-full px-4 py-3 rounded-xl text-rose-500 hover:bg-rose-50 border border-transparent hover:border-rose-100 transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">logout</span>
                    <span class="text-sm font-bold">Keluar Akun</span>
                </button>
            </form>
        </div>
    </div>
</aside>