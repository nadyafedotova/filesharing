<!doctype html>
<html lang="en">
<head>
    <title>File Sharing</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>
<body>
    @include("layouts.nav")
    <main class="container">
        @yield("content")
    </main>
    <script src="{{ asset("js/app.js") }}"></script>
</body>
</html>
