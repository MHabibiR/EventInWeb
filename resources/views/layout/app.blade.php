<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventIn - @yield('title')</title>
    </head>
<body class="bg-slate-50">

    @include('layout.header')

    <div class="flex">
        @include('layout.sidebar')

        <main class="flex-1 ml-72 min-h-screen">
            @yield('content')
        </main>
    </div>

</body>
</html>