<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Auth</title>
    <link rel="icon" href="{{ asset('images/icons/fcompany.png') }}">

    {{-- Include auth styles via Vite --}}
    @vite(['resources/css/auth.css'])
</head>
<body>
    {{ $slot }}

    {{-- Include scripts via Vite and a fallback jQuery already loaded in the view if needed --}}
    @vite(['resources/js/auth.js'])
</body>
</html>
