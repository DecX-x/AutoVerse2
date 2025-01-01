<style>
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #60a5fa;
        --secondary-color: #6c757d;
        --background-color: #f0f6ff;
        --text-color: #1e293b;
        --card-bg: #ffffff;
        --nav-bg: rgba(255, 255, 255, 0.9);
        --input-bg: #ffffff;
        --input-border: #cbd5e1;
        --box-shadow: 0 8px 20px rgba(37, 99, 235, 0.1);
        --hover-transform: translateY(-2px);
        --gradient-start: #f0f6ff;
        --gradient-end: #e0eaff;
    }

    [data-bs-theme="dark"] {
        --primary-color: #3b82f6;
        --primary-dark: #2563eb;
        --primary-light: #60a5fa;
        --secondary-color: #94a3b8;
        --background-color: #0f172a;
        --text-color: #e2e8f0;
        --card-bg: #1e293b;
        --nav-bg: rgba(15, 23, 42, 0.95);
        --input-bg: #1e293b;
        --input-border: #334155;
        --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        --gradient-start: #0f172a;
        --gradient-end: #1e293b;
        --header-bg: #1e293b;
        --border-color: #334155;
    }

    /* Dark mode styles */
    [data-bs-theme="dark"] .navbar {
        border-bottom: 1px solid #334155;
    }

    // ...existing dark mode styles...

    /* Base styles */
    body {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        color: var(--text-color);
        min-height: 100vh;
        transition: all 0.5s ease;
    }

    // ...existing styles...

    /* Responsive styles */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: var(--nav-bg);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            box-shadow: var(--box-shadow);
        }
        // ...existing mobile styles...
    }

    @media (min-width: 992px) {
        .navbar .container {
            padding-left: 0;
            max-width: 95%;
            margin-left: 2rem;
        }
        // ...existing desktop styles...
    }
</style>
