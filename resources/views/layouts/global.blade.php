<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>{{ $title ?? 'Halaman Utama' }}</title>
</head>

<body>
    <x-navbar-custom />

    <main>
        {{ $slot }}
    </main>


    <x-footer />
</body>

</html>
