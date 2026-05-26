<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventIn - @yield('title')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Manrope:wght@400;700;800;900&display=swap" rel="stylesheet">
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
        
        /* Gaya Kustom State Aktif menggunakan Pure CSS (Aman dari batasan CDN) */
        .active-link-custom { 
            color: #0891b2 !important; 
            font-weight: 700 !important; 
            border-right: 4px solid #06b6d4 !important; 
            background-color: rgba(226, 232, 240, 0.5) !important; 
        }
        .active-link-custom .material-symbols-outlined { 
            font-variation-settings: 'FILL' 1 !important; 
        }
    </style>
</head>
<body class="bg-[#f8fafb] font-inter text-slate-800 antialiased">

    @include('layout.sidebar')

    <div class="flex flex-col min-h-screen">
        
        @include('layout.header')

        <div class="w-full">
            @yield('content')
        </div>

    </div>

</body>
</html>