<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="Invoices app" />
    <link rel="icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180" />
    <link rel="mask-icon" href="/mask-icon.svg" color="#FFFFFF" />
    <meta name="theme-color" content="#ffffff" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Timelogger App</title>

    <script>
      @auth
        window.Auth = @json(auth()->user()->info())

      @endauth
    </script>

    <!-- Scripts -->
    @vite(['ui/main.js'])
  </head>
  <body class="tw-antialiased">
    <div id="app"></div>
  </body>
</html>
