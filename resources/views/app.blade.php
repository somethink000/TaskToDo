<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TaskToDo') }}</title>
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('img/icons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="stylesheet" href="/css/base.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    @vite(['resources/js/app.js'])
</head>

<body>
    <app id="app"></app>
</body>

</html>
