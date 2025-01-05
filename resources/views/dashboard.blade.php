<!-- home.blade.php -->
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Navbar --> 
     @include('layouts.navbar')

    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        <!-- Hero Section -->
        <section class="py-5 text-center fade-in">
            <h1 class="display-4 fw-bold mb-4">Welcome to AutoVerse</h1>
            <p class="lead mb-4">Discover premium automotive parts and accessories</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
                <a href="#" class="btn btn-outline-primary btn-lg">Learn More</a>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-5 fade-in">
            <h2 class="text-center mb-4">Popular Categories</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-car fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Car Parts</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-tools fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Tools</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-oil-can fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Accessories</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const icon = themeToggle.querySelector('i');
            
            const savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });

            function updateIcon(theme) {
                icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            }
        });
    </script>
</body>
</html>