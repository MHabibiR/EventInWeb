<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management EventIn - @yield('title')</title>

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
<body class="min-h-screen flex bg-slate-50 overflow-x-hidden">

    @include('layout.sidebar')

    <div class="flex-1 min-w-0 flex flex-col">
        
        @include('layout.header')

        @yield('content')
        
    </div>

</body>
</html>