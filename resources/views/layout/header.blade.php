<?php
// Tentukan base URL aplikasi Anda
$base_url = "http://localhost/FinalS4/Ver1/"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management EventIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Manrope:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        :root {
            --color-primary: #006876;
            --color-primary-container: #00bcd4;
            --font-headline: "Manrope", sans-serif;
        }
        body { font-family: "Inter", sans-serif; background-color: #f8fafb; }
        .font-headline { font-family: var(--font-headline); }
        .primary-gradient { background: linear-gradient(135deg, #006876 0%, #00bcd4 100%); }
        .nav-link { @apply flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 transition-colors duration-200; }
        .nav-link:hover { background-color: rgba(226, 232, 240, 0.5); }
        .active-link { color: #0891b2; font-weight: 700; border-right: 4px solid #06b6d4; background-color: rgba(226, 232, 240, 0.5); }
        .active-link .material-symbols-outlined { font-variation-settings: 'FILL' 1; }
    </style>
</head>
<body class="min-h-screen">
    <header class="ml-72 flex items-center justify-between h-20 px-8 sticky top-0 z-40 bg-white/70 backdrop-blur-xl border-b border-slate-100 font-headline">
        <div class="flex items-center gap-8 flex-1">
            <span class="text-lg font-black text-slate-900 uppercase tracking-wider hidden lg:block">Management Events</span>
            <div class="flex items-center bg-slate-100 px-4 py-2 rounded-full w-full max-w-md gap-3">
                <span class="material-symbols-outlined text-slate-400">search</span>
                <input type="text" class="bg-transparent border-none focus:outline-none text-sm w-full" placeholder="Cari event atau peserta...">
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative group cursor-pointer">
                <span class="material-symbols-outlined text-slate-400 group-hover:text-cyan-600 transition-colors">notifications</span>
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 border-2 border-white rounded-full text-[8px] flex items-center justify-center text-white font-bold">2</span>
                
                <div class="absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-2xl border border-slate-100 p-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-900 mb-4">Notifikasi Terbaru</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                            <p class="text-[10px] font-bold text-emerald-700">PROPOSAL DISETUJUI</p>
                            <p class="text-[11px] text-slate-600 mt-1">Event 'Architecture Summit' telah aktif.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative group cursor-pointer flex items-center gap-3 ml-2">
                <div class="text-right">
                    <p class="text-xs font-black text-slate-900">Studio Karawang</p>
                    <p class="text-[9px] font-bold text-cyan-600 uppercase">Organizer</p>
                </div>
                <img src= "<?= $base_url ?>assets/MBG.jpg" class="w-10 h-10 rounded-xl object-cover border-2 border-slate-100">
                
                <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                    <a href="<?= $base_url ?>profile.php" class="flex items-center gap-3 p-4 hover:bg-slate-50 text-slate-600 transition-colors">
                        <span class="material-symbols-outlined text-sm">person_edit</span>
                        <span class="text-xs font-bold">Edit Profil</span>
                    </a>
                    <hr class="border-slate-50">
                    <a href="<?= $base_url ?>auth/logout.php" class="flex items-center gap-3 p-4 hover:bg-rose-50 text-rose-500 transition-colors">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        <span class="text-xs font-bold">Keluar Sistem</span>
                    </a>
                </div>
            </div>
        </div>
    </header>