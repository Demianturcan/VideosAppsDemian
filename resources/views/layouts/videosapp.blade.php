<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <link rel="icon" href="{{ asset('7369102.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="flex flex-col min-h-screen">
<header>
    <nav class="bg-gray-100 border-b-[1px] border-rose-700">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
            <a href="/videos"
               class="text-gray-800 font-bold text-2xl mb-4 lg:mb-0 hover:text-rose-700 hover:cursor-pointer no-underline">Videos
                App
            </a>

            <div class="lg:hidden">
                <button class="text-gray-800 focus:outline-none">
                    <svg class="h-6 w-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"
                        ></path>
                    </svg>
                </button>
            </div>

            <div class="lg:flex lg:flex-row lg:space-x-4 lg:mt-0 mt-4 flex flex-col items-center text-lg">
                <a href="{{ route('videos') }}"
                   class="text-gray-800 px-4 py-2 hover:text-rose-700 hover:-translate-y-0.5 no-underline transition-transform duration-300">Home</a>
                <a href="{{ route('videos.manage') }}"
                   class="text-gray-800 px-4 py-2 hover:text-rose-700 hover:-translate-y-0.5 no-underline transition-transform duration-300 ">Manage</a>
            </div>

            <div class="lg:flex lg:flex-row lg:space-x-4 lg:mt-0 mt-4 flex flex-col items-center text-lg">
                @guest
                    <div class="flex flex-row items-center">
                        <a href="{{ route('login') }}"
                           class="text-gray-800 p-1 mr-2 text-base hover:text-rose-700 no-underline">Log in</a>
                        <a href="{{ route('register') }}"
                           class="text-gray-800 p-1 text-base hover:text-rose-700 no-underline">Register</a>
                    </div>
                @endguest

                @auth
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>
        </div>

    </nav>
</header>

<main class="flex-grow">
    @yield('content')
</main>

<footer>
    <footer aria-labelledby="footer-heading" class="bg-gray-100 text-gray-200 py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center">
                <p class="text-gray-800 text-center">© 2024 Demian. All rights reserved.</p>
            </div>
        </div>
    </footer>
</footer>
</body>
</html>
