<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutoVerse - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
                        <h2 class="h1 mb-4">Join Our Automotive Community</h2>
                        <p class="lead mb-5">Create an account to start your automotive journey with us</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4 floating">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold gradient-text">Create Account</h3>
                                <p class="text-secondary">Already have an account? <a href="{{ route('login') }}" class="text-primary">Sign in</a></p>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="fade-in">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" id="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                    <label for="name">Full Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
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
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" 
                                           name="password_confirmation" id="password_confirmation" 
                                           placeholder="Confirm Password" required>
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                    <label class="form-check-label text-secondary" for="terms">
                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and 
                                        <a href="#" class="text-primary">Privacy Policy</a>
                                    </label>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">Create Account</button>
                                </div>
                            </form>
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
            
            const savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                document.body.classList.add('theme-transitioning');
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);

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