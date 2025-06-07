{{-- resources/views/components/guest-layout.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hola Cafe Menu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind + your app scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-secondary-450 text-primary-500">
{{ $slot }}
<footer class="bg-primary-500 dark:bg-primary-500 py-4 w-full">
    <div class="max-w-10xl mx-auto text-center text-sm text-secondary-450 dark:text-secondary-450">
        &copy; {{ date('Y') }} <a href="http://ubejdqazimi.com/"> Ubejd Qazimi</a>
    </div>
</footer>
</div>
</body>
</html>
