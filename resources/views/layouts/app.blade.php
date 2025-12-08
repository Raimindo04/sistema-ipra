<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IPRA FORM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 antialiased">
    <div id="app">
        <!-- NAVBAR -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <!-- Left (Logo) -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800">
                            {{ __( 'Imoveis') }}
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button id="mobileMenuBtn" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Right side menu -->
                    <div class="hidden sm:flex sm:items-center sm:space-x-4">

                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">
                                    {{ __('Login') }}
                                </a>
                            @endif


                        @else
                            <!-- Auth Dropdown -->
                            <div class="relative">
                                <button id="userMenuBtn"
                                        class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="userMenu"
                                     class="hidden absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg py-1">
                                    <a href="{{ route('logout') }}"
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                    @can('manageRoles', App\Models\Role::class)
                                     <a href="{{ route('roles.index') }}"
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        {{ __('Roles') }}
                                    </a>
                                    @endcan @can('manageUsers', App\Models\User::class)
                                    <a href="{{ route('users.index') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        {{ __('Users') }}
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        @endguest

                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="sm:hidden hidden px-4 pb-3 space-y-2 bg-white border-t">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-gray-900">
                            {{ __('Login') }}
                        </a>
                    @endif


                @else
                    <a href="#" class="block text-gray-700">
                        {{ Auth::user()->name }}
                    </a>

                    <a href="{{ route('logout') }}"
                       class="block text-gray-700 hover:text-gray-900"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    @can('manageRoles', App\Models\Role::class)
                    <a href="{{ route('roles.index') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        {{ __('Roles') }}
                    </a>
                    @endcan
                    @can('manageUsers', App\Models\User::class)
                    <a href="{{ route('users.index') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        {{ __('Users') }}
                    </a>
                    @endcan
                @endguest
            </div>
        </nav>

        <!-- PAGE CONTENT -->
        <main class="py-6">
            @yield('content')
        </main>
    </div>

    <!-- Script para dropdown e menu mobile -->
    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        document.getElementById('userMenuBtn')?.addEventListener('click', () => {
            document.getElementById('userMenu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
