<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Registo de Imovel')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>

      @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen">
        <nav class="bg-blue-600 text-white p-4">Sistema de Registo de Imovel</nav>
        <main class="p-6">
            @yield('content')
        </main>
        @livewireScripts
    </div>
</body>
</html>
