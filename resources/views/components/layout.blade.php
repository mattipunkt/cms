<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinemaManagementSystem</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
</head>
<body>
        <x-navbar>
    </x-navbar>
<div class="container">

    <br>
    @if(session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
        <br>
    @endif
    {{ $slot }}
</div>
</body>
</html>
