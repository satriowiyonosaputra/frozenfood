    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Frozen Food - Toko Online Makanan Beku">
        <meta name="author" content="FrozenFood Team">
        <meta name="keywords" content="frozen food, makanan beku, toko online">

        <title>{{ $title ?? 'FrozenFood' }}</title>

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- External Scripts & Libraries -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <!-- Livewire Styles -->
        @livewireStyles
    </head>

    <body class="bg-slate-200 dark:bg-white">

        <!-- Navbar -->
        @livewire('partials.navbar')

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        @livewire('partials.footer')

        <!-- Livewire Scripts -->
        @livewireScripts

        <!-- Custom Animation -->
        <style>
            @keyframes zoomFade {
                0% {
                    transform: scale(0.95);
                    opacity: 0;
                }
                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            .animate-zoomFade {
                animation: zoomFade 1s ease-out forwards;
            }
        </style>

    </body>

    </html>
