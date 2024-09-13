<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TaskToDo') }}</title>
    <link rel="icon" type="image/x-icon" href="images/check.png">
    <meta name="theme-color" content="#6777ef" />
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="stylesheet" href="/css/base.css">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite(['resources/js/app.js'])
</head>

<body>
    <app id="app"></app>
</body>

</html>
