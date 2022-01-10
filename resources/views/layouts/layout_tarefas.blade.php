<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>@yield('title') - LARAVEL</title>
    <meta charset="utf-8">
</head>
<body>
    <header>
        <h1>Header</h1>
    </header>
    <hr/>
    <section>
        @yield('content')
    </section>
    <hr/>
    <footer>
        <h1>Footer</h1>
    </footer>
</body>
</html>
