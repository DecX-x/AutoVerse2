<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>AutoVerse</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">AutoVerse</a>
            <button class="btn btn-dark" id="themeToggle">Dark Mode</button>
        </div>
    </nav>
    @yield('content')
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;

        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            htmlElement.setAttribute('data-bs-theme', newTheme);
            themeToggle.textContent = newTheme === 'light' ? 'Dark Mode' : 'Light Mode';
        });
    </script>
</body>
</html>
