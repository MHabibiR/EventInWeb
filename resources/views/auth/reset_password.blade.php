<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi - EventIn</title>
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
            <h2 class="text-xl font-bold text-slate-800 mt-6">Buat Kata Sandi Baru</h2>
            <p class="text-sm text-slate-500 mt-2">Silakan masukkan kata sandi baru Anda di bawah ini untuk mengakses kembali akun Anda.</p>
        </div>

        <form action="{{ url('/reset-password-process') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ request()->get('token') }}">

            <div>
                <label for="email" class="block text-sm font-bold text-slate-900 mb-2 ml-1">Alamat Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                    <input type="email" id="email" name="email" value="{{ request()->get('email') }}" class="w-full bg-slate-100 border border-slate-200 text-slate-500 rounded-xl py-3 pl-12 pr-4 outline-none cursor-not-allowed font-bold" readonly>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-900 mb-2 ml-1">Kata Sandi Baru</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                    <input type="password" id="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 transition-all font-bold" placeholder="Minimal 8 karakter" required>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-900 mb-2 ml-1">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock_reset</span>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 transition-all font-bold" placeholder="Ulangi kata sandi baru" required>
                </div>
            </div>

            <button type="submit" class="w-full primary-gradient text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-cyan-500/25 hover:scale-[1.02] active:scale-95 transition-all mt-4">
                Simpan Kata Sandi Baru
            </button>
        </form>
    </div>

</body>
</html>