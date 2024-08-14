{{-- resources/views/welcome.blade.php --}}
<x-guest-layout>
    <!-- Header Section -->
    <header class="w-full bg-white shadow-md">
        <nav class="flex justify-between items-center max-w-6xl mx-auto px-6 py-4">
            <!-- Logo -->
            <div>
                <a href="{{ route('welcome') }}" class="text-2xl font-bold text-indigo-600">Manager Music</a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <x-nav-link href="{{ route('items.index') }}" :active="request()->routeIs('items.index')">
                    Canciones
                </x-nav-link>
                <x-nav-link href="{{ route('categorias.index') }}" :active="request()->routeIs('categorias.index')">
                    Categorías
                </x-nav-link>
                <x-nav-link href="#features">
                    Características
                </x-nav-link>
                <x-nav-link href="#contact">
                    Contacto
                </x-nav-link>
                @auth
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                @endauth
            </div>
            <!-- Auth Links -->
            @if (Route::has('login'))
                <div class="hidden md:flex space-x-4">
                    @auth
                        <!-- Reuse Jetstream Dropdown for Authenticated Users -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
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
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 border border-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition-colors duration-300">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 transition-colors duration-300">Registrarse</a>
                    @endauth
                </div>
            @endif
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden flex flex-col space-y-2 px-6 pb-4">
            <x-responsive-nav-link href="{{ route('items.index') }}" :active="request()->routeIs('items.index')">
                Ítems
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('categorias.index') }}" :active="request()->routeIs('categorias.index')">
                Categorías
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#features">
                Características
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#contact">
                Contacto
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>
                <!-- Mobile Dropdown for User -->
                <div class="relative">
                    <button id="mobile-user-menu-button" class="flex items-center text-gray-700 hover:text-indigo-600 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Content -->
                    <div id="mobile-user-menu" class="hidden mt-2 w-full bg-white border border-gray-200 rounded shadow-lg">
                        <x-responsive-nav-link href="{{ route('profile.show') }}">
                            Perfil
                        </x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                Cerrar Sesión
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 border border-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition-colors duration-300">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 transition-colors duration-300">Registrarse</a>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 text-gray-800">
        <!-- Hero Section with Video -->
        <div class="max-w-2xl p-8 bg-white rounded-lg shadow-lg mb-10 text-center">
            <h1 class="text-5xl font-extrabold text-indigo-600 mb-4 animate__animated animate__fadeInDown">Bienvenido a Manager Music</h1>
            <p class="text-lg text-gray-700 mb-8 animate__animated animate__fadeInUp">Administra tus canciones y categorías de manera rápida y eficiente.</p>
           
            <div class="mt-8">
                <iframe class="w-full h-64 md:h-96 rounded-lg shadow-lg" src="https://www.youtube.com/embed/tgbNymZ7vqY"
                    title="Video de presentación" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="w-full max-w-4xl py-12 px-6 bg-white rounded-lg shadow-lg mb-10">
            <h2 class="text-3xl font-semibold text-indigo-600 mb-6 text-center animate__animated animate__fadeIn">Características de la Plataforma</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col items-center text-center p-6 border border-gray-200 rounded-lg animate__animated animate__fadeInLeft">
                    <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 12.75h-5.5M3 18.5l6-6m0 0L3 6.5m6 6h11M21 17.5v-11M15 20h-2a3 3 0 01-3-3v-2a3 3 0 013-3h2m6 6v-2a3 3 0 00-3-3h-2a3 3 0 00-3 3v2a3 3 0 003 3h2m6 0h1M3 8.5h12"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Interfaz Intuitiva</h3>
                    <p class="text-gray-600">Navega fácilmente con una interfaz diseñada para ser amigable y accesible.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 border border-gray-200 rounded-lg animate__animated animate__fadeInRight">
                    <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h3m-3 4h7m-7 4h10M6 16h.01M6 20h.01M6 12h.01M18 8h.01M18 12h.01M18 16h.01M18 20h.01M14 8h.01M10 8h.01M6 8h.01M4 4h16v16H4z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Seguridad Avanzada</h3>
                    <p class="text-gray-600">Protegemos tus datos con las mejores prácticas de seguridad.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 border border-gray-200 rounded-lg animate__animated animate__fadeInLeft">
                    <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3h14a2 2 0 012 2v16l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Acceso Rápido</h3>
                    <p class="text-gray-600">Accede a tus ítems y categorías con rapidez y eficiencia.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 border border-gray-200 rounded-lg animate__animated animate__fadeInRight">
                    <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13M16 5H8a2 2 0 00-2 2v1h12V7a2 2 0 00-2-2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Soporte Dedicado</h3>
                    <p class="text-gray-600">Nuestro equipo está siempre listo para ayudarte con cualquier consulta.</p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div id="contact" class="w-full max-w-4xl py-12 px-6 bg-indigo-50 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-indigo-600 mb-6 text-center">Contáctanos</h2>
            <p class="text-center text-gray-700 mb-6">¿Tienes preguntas? No dudes en contactarnos para más información.</p>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <input type="text" placeholder="Nombre Completo" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-300">
                </div>
                <div class="md:col-span-2">
                    <input type="email" placeholder="Correo Electrónico" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-300">
                </div>
                <div class="md:col-span-2">
                    <textarea rows="4" placeholder="Mensaje" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-300"></textarea>
                </div>
                <div class="md:col-span-2 text-center">
                    <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 transition-colors duration-300">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="w-full py-6 bg-gray-800 text-gray-300 text-center">
        <div class="flex justify-center space-x-4 mb-4">
            <!-- Twitter Button -->
            <button class="hover:scale-110 transition-transform duration-300">
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512" fill="#1e90ff">
                        <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                    </svg>
                </a>
            </button>

            <!-- Instagram Button -->
            <button class="hover:scale-110 transition-transform duration-300">
                <a href="https://www.instagram.com/berny2020_/" target="_blank" rel="noopener noreferrer" class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512" fill="#ff00ff">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                    </svg>
                </a>
            </button>

            <!-- GitHub Button -->
            <button class="hover:scale-110 transition-transform duration-300">
                <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 496 512" fill="#ffffff">
                        <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path>
                    </svg>
                </a>
            </button>

            <!-- Facebook Button -->
            <button class="hover:scale-110 transition-transform duration-300">
                <a href="https://www.facebook.com/stiff.otarola.71/" target="_blank" rel="noopener noreferrer" class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 320 512" fill="#4267B2">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                    </svg>
                </a>
            </button>
        </div>
        <p>© 2024 Gestor Pro. Todos los derechos reservados.</p>
    </footer>

    <!-- Script for Mobile Menu -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        document.getElementById('mobile-user-menu-button').addEventListener('click', function () {
            const userMenu = document.getElementById('mobile-user-menu');
            userMenu.classList.toggle('hidden');
        });
    </script>
</x-guest-layout>
