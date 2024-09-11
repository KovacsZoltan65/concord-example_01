<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{ $title ?? '' }}</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="base-url" content="{{ url()->to('/') }}">

        @stack('meta')

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

        <!--<link rel="preload" as="image" href="{{ url('cache/logo/bagisto.png') }}" >-->

        @stack('styles')
    </head>
    <body class="h-full font-inter dark:bg-gray-950">
    <div id="app" class="h-full" >
            {{ $slot }}
        </div>
    </body>
</html>
