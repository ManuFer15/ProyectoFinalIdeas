<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-background text-foreground">
        <x-layout.nav />
        <main class="max-w-7x1 mx-auto px-6">
            {{ $slot }}
        </main>

        @session('success')
            <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                 x-transsition.opacity.duration.300ms
                 class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded">
                {{ $value }}
            </div>
        @endsession
    </body>
</html>
