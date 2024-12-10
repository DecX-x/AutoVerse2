<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutoVerse - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --secondary-color: #6c757d;
            --background-color: #f0f6ff;
            --text-color: #1e293b;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --box-shadow: 0 8px 20px rgba(37, 99, 235, 0.1);
            --hover-transform: translateY(-2px);
            --gradient-start: #f0f6ff;
            --gradient-end: #e0eaff;
        }

        [data-bs-theme="dark"] {
            --primary-color: #60a5fa;
            --primary-dark: #3b82f6;
            --primary-light: #93c5fd;
            --secondary-color: #94a3b8;
            --background-color: #0f172a;
            --text-color: #f1f5f9;
            --card-bg: #1e293b;
            --input-bg: #334155;
            --input-border: #475569;
            --box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
            --gradient-start: #0f172a;
            --gradient-end: #1e293b;
        }

        body {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            transition: all 0.5s ease;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            width: 100%;
            padding: 2rem 0;
        }

        .card {
            background: var(--card-bg);
            border: none;
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: var(--hover-transform);
        }

        .form-control, .form-floating>.form-control {
            background-color: var(--input-bg);
            border-color: var(--input-border);
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }

        .form-floating>label {
            color: var(--text-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
            border: none;
            color: white;
            box-shadow: var(--box-shadow);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            background: var(--primary-dark);
        }

        .gradient-text {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .social-login .btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 8px;
            transition: all 0.3s ease;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .social-login .btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: var(--hover-transform);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .theme-toggle {
                top: 10px;
                right: 10px;
                width: 40px;
                height: 40px;
            }

            .card-body {
                padding: 1.5rem;
            }

            .gradient-text {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
        <i class="fas fa-sun"></i>
    </button>

    <div class="main-container">
        <div class="container">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="text-center fade-in">
                        <h1 class="display-3 fw-bold mb-4 gradient-text">AutoVerse</h1>
                        <div class="d-flex justify-content-center">
                            <hr class="w-25 border-primary mb-4">
                        </div>
                        <h2 class="h1 mb-4">Your Ultimate Automotive Destination</h2>
                        <p class="lead mb-5">Discover, Shop, and Experience the Best in Automotive Excellence</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4 floating">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold gradient-text">Sign in</h3>
                                <p class="text-secondary">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign up</a></p>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="fade-in">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" id="email" placeholder="name@example.com" required>
                                    <label for="email">Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" id="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label text-secondary" for="remember">
                                        Keep me logged in
                                    </label>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">Log in now</button>
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <a href="#" class="text-primary text-decoration-none">Forgot password?</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const icon = themeToggle.querySelector('i');
            
            // Load saved theme
            const savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);

            // Theme toggle handler
            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                // Add transition class
                document.body.classList.add('theme-transitioning');
                
                // Update theme
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);

                // Remove transition class
                setTimeout(() => {
                    document.body.classList.remove('theme-transitioning');
                }, 500);
            });

            function updateIcon(theme) {
                icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            }
        });
    </script>
</body>
</html>