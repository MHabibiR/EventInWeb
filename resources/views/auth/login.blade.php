<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <style>
        :root {
            --color-primary: #006876;
            --color-primary-container: #00bcd4;
            --font-headline: "Manrope", sans-serif;
            --font-body: "Inter", sans-serif;
        }
        body { 
            font-family: var(--font-body); 
            background-color: #f8fafb; 
            background-image: radial-gradient(circle at 2px 2px, #e1e3e4 1px, transparent 0);
            background-size: 32px 32px;
        }
        .font-headline { font-family: var(--font-headline); }
        .primary-gradient {
            background: linear-gradient(135deg, #006876 0%, #00bcd4 100%);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(187, 201, 204, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="inline-flex w-20 h-20 sm:w-40 sm:h-14 primary-gradient rounded-2xl items-center justify-center text-white shadow-lg shadow-cyan-500/30 mb-6">
                <span style="font-variation-settings: 'FILL' 1;">EventIn</span>
            </div>
            <h1 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-slate-500 mt-2 font-medium">Event Management EventIn</p>
        </div>

        <div class="glass-panel p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/50">
            <form action="{{ url('/login-process') }}" method="POST" class="space-y-6">
                @csrf @if($errors->has('login_error'))
                    <div class="bg-rose-50 text-rose-600 text-sm font-bold p-4 rounded-xl border border-rose-100 mb-4">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-800 mb-2 ml-1">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 transition-all" placeholder="admin@eventin.com" required>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-2 ml-1">
                        <label for="password" class="text-sm font-bold text-slate-800">Password</label>
                        <a href="{{ url('/lupa_password') }}" class="text-xs font-bold text-cyan-700 hover:text-cyan-600 transition-colors">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                        <input type="password" id="password" name="password" required
                            class="w-full bg-white/50 border border-slate-200 rounded-2xl pl-12 pr-4 py-4 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <label class="flex items-center gap-3 cursor-pointer group w-fit">
                    <div class="relative flex items-center">
                        <input type="checkbox" class="peer appearance-none w-5 h-5 border-2 border-slate-300 rounded-md checked:bg-cyan-600 checked:border-cyan-600 transition-all">
                        <span class="material-symbols-outlined absolute text-white text-sm scale-0 peer-checked:scale-100 transition-transform left-0.5 pointer-events-none">check</span>
                    </div>
                    <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Remember this device</span>
                </label>

                <button type="submit" class="w-full primary-gradient text-white py-4 rounded-2xl font-bold text-lg shadow-lg shadow-cyan-500/25 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
                    <span>Login</span>
                    <span class="material-symbols-outlined">login</span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>