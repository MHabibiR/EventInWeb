<?php
// Mendapatkan nama file saat ini untuk menentukan link aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="h-screen w-72 flex flex-col fixed left-0 top-0 bg-slate-50 shadow-[inset_-1px_0_0_0_rgba(0,0,0,0.05)] font-headline z-50">
    <div class="flex flex-col h-full py-8 px-6">
        <div class="mb-10 flex items-center gap-3">
            <div class="w-10 h-10 primary-gradient rounded-xl flex items-center justify-center text-white">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">architecture</span>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-900">EventIn</h1>
                <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Manajemen Event</p>
            </div>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="<?= $base_url ?>index.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'index.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="<?= $base_url ?>main_admin/events.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'events.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">calendar_add_on</span>
                <span class="font-medium">Events</span>
            </a>
            <a href="<?= $base_url ?>main_admin/proposals.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'proposals.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">description</span>
                <span class="font-medium">Proposal</span>
            </a>
            <a href="<?= $base_url ?>organizer/peserta.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'peserta.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">group</span>
                <span class="font-medium">Peserta</span>
            </a>
            <a href="<?= $base_url ?>organizer/seating.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'seating.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">event_seat</span>
                <span class="font-medium">Tempat Duduk</span>
            </a>
            <a href="<?= $base_url ?>organizer/lucky_draw.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'lucky_draw.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">celebration</span>
                <span class="font-medium">Undian Berhadiah</span>
            </a>
            <a href="<?= $base_url ?>organizer/sertifikat.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'sertifikat.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">card_membership</span>
                <span class="font-medium">Sertifikat</span>
            </a>
            <a href="<?= $base_url ?>organizer/checkin.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'checkin.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">qr_code_scanner</span>
                <span class="font-medium">Check-in Scan</span>
            </a>
            <a href="<?= $base_url ?>main_admin/manage_events.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'manage_events.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">settings_suggest</span>
                <span class="font-medium">Manajemen Events</span>
            </a>
            <a href="<?= $base_url ?>main_admin/manage_organizer.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'manage_organizer.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">settings_suggest</span>
                <span class="font-medium">Manajemen organizer</span>
            </a>
            <a href="<?= $base_url ?>organizer/dashboard_organizer.php" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl <?= $current_page == 'dashboard_organizer.php' ? 'active-link' : 'text-slate-500 hover:bg-slate-200/50' ?>">
                <span class="material-symbols-outlined">settings_suggest</span>
                <span class="font-medium">Dashboard organizer</span>
            </a>
        </nav>

        <a href="$base_url/main_admin/events.php" class="mt-8 primary-gradient text-white py-4 px-6 rounded-2xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-cyan-500/20 active:scale-95 transition-all">
            <span class="material-symbols-outlined">add_circle</span>
            <span>Buat Event Baru</span>
        </a>
    </div>
</aside>