<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta name="site_url" content="{{ url('/') }}">
</head>

<body>
    <h1>Stundent form</h1>

    <main>
        @yield('content')
    </main>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if(in_array(Route::currentRouteName(), [ 'students.create', 'students.show' ]))
    @vite(['resources/js/student.js'])
    @vite(['resources/js/state.js'])
    @vite(['resources/js/qualification.js'])
    @endif
</body>

</html>