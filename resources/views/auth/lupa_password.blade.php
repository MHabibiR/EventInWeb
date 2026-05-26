<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - EventIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        body { background-color: #f8fafb; background-image: radial-gradient(circle at 2px 2px, #e1e3e4 1px, transparent 0); background-size: 32px 32px; }
        .primary-gradient { background: linear-gradient(135deg, #006876 0%, #00bcd4 100%); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen font-sans p-6">

    <div class="w-full max-w-md p-8 bg-white/90 backdrop-blur-md rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Event<span class="text-cyan-600">In</span></h1>
            <h2 class="text-xl font-bold text-slate-800 mt-6">Lupa Kata Sandi?</h2>
            <p class="text-sm text-slate-500 mt-2">Masukkan email yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
        </div>

        <form action="{{ url('/lupa-password-process') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-slate-900 mb-2 ml-1">Alamat Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                    <input type="email" id="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-4 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 transition-all" placeholder="contoh@email.com" required>
                </div>
            </div>

            <button type="submit" class="w-full primary-gradient text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-cyan-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                Kirim Tautan Reset
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="text-sm font-bold text-slate-500 hover:text-cyan-600 flex items-center justify-center gap-2 transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali ke halaman Login
            </a>
        </div>
    </div>

</body>
</html>