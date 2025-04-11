<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img class="h-8 w-auto" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo">
                    </a>
                    <div class="hidden sm:flex sm:space-x-4 ml-6">
                        <a href="{{ route('home') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            Beranda
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">Login</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">Register</a>
                    @endguest

                    @auth
                        <!-- Notification Icon -->
                        <button class="text-gray-400 hover:text-white p-1 focus:outline-none focus:ring-2 focus:ring-white rounded-full">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                                <img class="h-8 w-8 rounded-full" src="https://files.catbox.moe/3969a7.png" alt="user">
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black/5 py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile menu (optional) -->
        <div class="sm:hidden px-2 pt-2 pb-3 space-y-1" id="mobile-menu">
            <a href="{{ route('home') }}"
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                Beranda
            </a>
        </div>
    </nav>

    <!-- Main content -->
    <main>
        {{ $slot }}
    </main>
</body>

</html>
