<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Para tener disponible el css y el js -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
        <title>Document</title>
    </head>
    <body>
        <x-layouts.header/>
        @auth
            <x-layouts.nav/>
        @endauth
        <main class="h-main bg-main">
            {{$slot}}
        </main>
        <x-layouts.footer/>
    </body>
</html>
