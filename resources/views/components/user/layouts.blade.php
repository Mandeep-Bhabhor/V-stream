<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>V-Stream</title>

    <!-- Zephyr Theme CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Preload Custom Font -->
    <link rel="preload" href="/fonts/AbolitionTest-Regular.otf" as="font" type="font/otf" crossorigin="anonymous">

    <style>
        /* Custom Font */
        @font-face {
            font-family: 'Abolition';
            src: url('/fonts/AbolitionTest-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        /* Animated Multicolor Background */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d7c7c7, rgb(165, 24, 29), #ffffff);
            background-size: 600% 600%;
            animation: backgroundFlow 20s ease infinite;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @keyframes backgroundFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: rgba(107, 5, 5, 0.95);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .navbar {
            height: 70px;
            /* fixed height */
            padding: 0 2rem;
            /* remove vertical padding */
            display: flex;
            align-items: center;
            /* vertical centering */
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: 700;
            font-family: 'Abolition', sans-serif;
            text-shadow: 0 0 6px rgba(0, 230, 118, 0.5);
        }



        .navbar-nav .nav-link {
            color: #e0e0e0;
            font-size: 1rem;
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #00e676;
            text-shadow: 0 0 6px rgba(0, 230, 118, 0.4);
        }

        .user-btn {
            background-color: #00e676;
            color: #121212;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .diagonal-text {
            background: linear-gradient(30deg, white 0%, red 70%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            /* increase as needed */
            font-weight: 700;
            font-family: 'Abolition', sans-serif;
            text-shadow: 0 0 6px rgba(0, 230, 118, 0.5);
            line-height: 1;
            /* prevents extra spacing */
            margin: 0;
            /* remove default margin */
        }

        .dropdown-menu {
            background-color: #1f1f1f;
            border: none;
        }

        .dropdown-item {
            color: #e0e0e0;
        }

        .dropdown-item:hover {
            background-color: #2c2c2c;
            color: #00e676;
        }

        main {
            flex: 1;
            padding: 2rem;
            max-width: 1400px;
            width: 100%;
            margin: 2rem auto;
        }

        footer {
            background-color: rgba(107, 5, 5, 0.95);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            color: #ccc;
            padding: 2rem 1rem;
            text-align: center;
            margin-top: auto;
            border-top: 1px solid #2e2e2e;
        }

        footer a {
            color: #00e676;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
        }

        .custom-welcome-heading {
            font-family: 'Abolition', sans-serif;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .user-btn {
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }

            main {
                padding: 1rem;
                margin: 1rem;
            }

            .custom-welcome-heading {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand diagonal-text" href="/">V-Stream</a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/liked">Liked</a></li>
                    </ul>

                    <!-- Search -->
                    <form class="d-flex ms-3 me-3" action="/search" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search videos..."
                            required>
                        <button class="btn btn-info" type="submit"><i class="bi bi-search"></i></button>
                    </form>

                    <!-- User Menu -->
                    <div class="dropdown">
                        @if (Auth::check())
                            <a class="user-btn dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>

                                <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                            </ul>
                        @else
                            <a class="btn btn-light ms-3" href="/login">Login</a>
                            <a class="btn btn-info ms-2" href="/register">Sign Up</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 V-Stream. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
