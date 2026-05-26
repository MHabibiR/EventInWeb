<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat - EventIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <style>
        :root {
            --color-primary: #006876;
            --color-primary-container: #00bcd4;
            --font-headline: "Manrope", sans-serif;
        }
        body { 
            font-family: "Inter", sans-serif; 
            background-color: #f8fafb;
            background-image: radial-gradient(circle at 2px 2px, #e1e3e4 1px, transparent 0);
            background-size: 40px 40px;
        }
        .font-headline { font-family: var(--font-headline); }
        .primary-gradient { background: linear-gradient(135deg, #006876 0%, #00bcd4 100%); }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.5s ease-out forwards; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-6">

    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-3 mb-6">
            <div class="w-12 h-12 primary-gradient rounded-2xl flex items-center justify-center text-white shadow-lg shadow-cyan-500/20">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified_user</span>
            </div>
            <h1 class="text-2xl font-black font-headline text-slate-900 tracking-tight">EventIn <span class="text-cyan-600">Verify</span></h1>
        </div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Verifikasi Keaslian Sertifikat</h2>
        <p class="text-slate-500 mt-2 font-medium">Masukkan ID Sertifikat untuk memeriksa validitas data peserta.</p>
    </div>

    <div class="w-full max-w-2xl bg-white p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100">
        <form onsubmit="event.preventDefault(); checkValidity();" class="flex flex-col md:flex-row gap-4 m-0">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">qr_code_scanner</span>
                <input type="text" id="cert-id" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl pl-14 pr-6 py-4 text-slate-900 font-bold placeholder:text-slate-400 focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all uppercase" 
                    placeholder="CONTOH: CERT-2026-XYZ-09122">
            </div>
            <button type="submit" class="primary-gradient text-white px-8 py-4 rounded-2xl font-black shadow-lg shadow-cyan-500/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined">search</span>
                PERIKSA
            </button>
        </form>

        <div class="mt-6 flex items-center justify-center gap-4 text-slate-400">
            <div class="h-[1px] flex-1 bg-slate-100"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Atau Pindai QR</span>
            <div class="h-[1px] flex-1 bg-slate-100"></div>
        </div>

        <button type="button" class="w-full mt-6 bg-slate-50 border-2 border-dashed border-slate-200 py-4 rounded-2xl text-slate-500 font-bold text-sm flex items-center justify-center gap-2 hover:bg-slate-100 transition-colors cursor-pointer group">
            <span class="material-symbols-outlined group-hover:text-cyan-600 transition-colors">photo_camera</span>
            Buka Kamera Scanner
        </button>
    </div>

    <div id="result-container" class="w-full max-w-2xl mt-8 hidden animate-fade-in">
        <div class="bg-emerald-50 border-2 border-emerald-100 rounded-[2.5rem] p-8 flex flex-col items-center text-center">
            <div class="w-20 h-20 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-xl shadow-emerald-500/20 mb-6">
                <span class="material-symbols-outlined text-4xl font-bold">check_circle</span>
            </div>
            <h3 class="text-2xl font-black text-emerald-900 tracking-tight">Sertifikat Valid</h3>
            <p class="text-emerald-700/70 font-medium text-sm mt-1">Data ditemukan di sistem EventIn profesional.</p>

            <div class="w-full grid grid-cols-2 gap-4 mt-8 pt-8 border-t border-emerald-200/50">
                <div class="text-left">
                    <label class="text-[10px] font-black text-emerald-600/50 uppercase tracking-widest">Nama Peserta</label>
                    <p class="font-bold text-emerald-900">Muhammad Habibi Rahman</p>
                </div>
                <div class="text-left">
                    <label class="text-[10px] font-black text-emerald-600/50 uppercase tracking-widest">Nama Acara</label>
                    <p class="font-bold text-emerald-900">Architecture Design Summit 2026</p>
                </div>
                <div class="text-left">
                    <label class="text-[10px] font-black text-emerald-600/50 uppercase tracking-widest">Tanggal Terbit</label>
                    <p class="font-bold text-emerald-900">{{ date('d F Y') }}</p>
                </div>
                <div class="text-left">
                    <label class="text-[10px] font-black text-emerald-600/50 uppercase tracking-widest">Status Kehadiran</label>
                    <p class="font-bold text-emerald-900 flex items-center gap-1"><span class="material-symbols-outlined text-sm">verified</span> Terverifikasi Hadir</p>
                </div>
            </div>
        </div>
    </div>

    <p class="mt-12 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
        &copy; 2026 EventIn Management System
    </p>

    <script>
        function checkValidity() {
            const inputVal = document.getElementById('cert-id').value;
            if(!inputVal) return;

            const result = document.getElementById('result-container');
            // Menampilkan hasil setelah tombol klik (Bisa dimodif jadi fetch AJAX backend)
            result.classList.remove('hidden');
            setTimeout(() => {
                result.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 100);
        }
    </script>
</body>
</html>