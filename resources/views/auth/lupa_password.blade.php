<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - EventIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-sm border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Event<span class="text-cyan-600">In</span></h1>
            <h2 class="text-xl font-bold text-slate-800 mt-6">Lupa Kata Sandi?</h2>
            <p class="text-sm text-slate-500 mt-2">Masukkan email yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
        </div>

        <form action="#" method="GET" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-bold text-slate-900 mb-2">Alamat Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                    <input type="email" id="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 transition-all" placeholder="contoh@email.com" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-4 rounded-xl transition-colors">
                Kirim Tautan Reset
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="text-sm font-medium text-slate-500 hover:text-cyan-600 flex items-center justify-center gap-2 transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali ke halaman Login
            </a>
        </div>
    </div>

</body>
</html>