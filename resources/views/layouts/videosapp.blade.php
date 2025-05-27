<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <link rel="icon" href="{{ asset('7369102.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('5e2fa4ea7b6537232ffa', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('videos');
        channel.bind('video.created', function (data) {
            console.log('New video created:', data);
            alert('New video created: ' + JSON.stringify(data));
        });
    </script>
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
                <a href="{{ route('series') }}"
                   class="text-gray-800 px-4 py-2 hover:text-rose-700 hover:-translate-y-0.5 no-underline transition-transform duration-300">Series</a>
                <a href="{{ route('users') }}"
                   class="text-gray-800 px-4 py-2 hover:text-rose-700 hover:-translate-y-0.5 no-underline transition-transform duration-300 ">Users</a>

                @can('manage-videos')
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="text-gray-800 px-4 py-2 hover:text-rose-700 hover:-translate-y-0.5 no-underline transition-transform duration-300">
                                    <a class="px-4 py-2">Manage</a>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('videos.manage') }}">
                                    {{ __('Videos') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('users.manage') }}">
                                    {{ __('Users') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('series.manage') }}">
                                    {{ __('Series') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    </div>

                    <a href="{{ route('notifications') }}"
                       class="relative text-gray-800 px-4 py-2 hover:text-rose-700 no-underline transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span id="notification-badge"
                              class="hidden absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                !
            </span>
                    </a>
                @endcan

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
                                    class="flex text-sm outline outline-1 outline-rose-700 rounded-full focus:outline-none transition-all duration-200 ease-in-out">
                                    <img class="h-9 w-9 rounded-full object-cover"
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

