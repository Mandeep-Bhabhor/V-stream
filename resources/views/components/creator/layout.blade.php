<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Creator Dashboard | V-Stream</title>

    <!-- Zephyr Theme CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preload" href="/fonts/AbolitionTest-Regular.otf" as="font" type="font/otf" crossorigin="anonymous">

    <style>
        @font-face {
            font-family: 'Abolition';
            src: url('/fonts/AbolitionTest-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }



        body {  
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1d2b64, #f8cdda, #1fa2ff, #12d8fa);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @keyframes gradientBG {
            20% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            50% {
                background-position: 0% 50%;
            }
        }
   
        .custom-h-heading {
            font-family: 'Abolition', sans-serif;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(11, 140, 173, 0.5);
        }

        .navbar {
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #00b0ff;
            font-family: 'Abolition', sans-serif;
        }

        .navbar-nav .nav-link {
            color: #000000;
            font-size: 1rem;
            padding: 0.8rem 1rem;
            transition: color 0.3s ease;
        }

        .diagonal-text {
            background: linear-gradient(30deg, rgb(221, 99, 6) 50%, rgb(2, 0, 0) 50%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.2rem;
            /* increase as needed */
            font-weight: 700;
            font-family: 'Abolition', sans-serif;
            text-shadow: 0 0 6px rgba(255, 255, 255, 0.5);
            line-height: 1;
            /* prevents extra spacing */
            margin: 0;
            /* remove default margin */
        }

        .navbar-nav .nav-link:hover {
            color: #00b0ff;
        }

        .user-btn {
            background-color: #00b0ff;
            color: #121212;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-weight: 500;
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
            color: #00b0ff;
        }

        main {
            flex: 1;
            padding: 2rem;
            max-width: 1400px;
            width: 100%;
            margin: 2rem auto;
        }

        footer {
            background-color: #1f1f1f;
            color: #ccc;
            padding: 2rem 1rem;
            text-align: center;
            margin-top: auto;
        }

        footer a {
            color: #00b0ff;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
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
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                {{-- <a class="navbar-brand" href="/creator/dashboard"></a> --}}
                <a class="navbar-brand diagonal-text" href="/creator/dashboard">Creator Dashboard | V-Stream</a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="/creatorview/dashboard">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="/creator/videos">My Videos</a></li>
                        <li class="nav-item"><a class="nav-link" href="/creator/upload">Upload</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="/creator/analytics">Analytics</a></li>
            <li class="nav-item"><a class="nav-link" href="/creator/settings">Settings</a></li> --}}
                    </ul>

                    <!-- Creator Menu -->
                    <div class="dropdown">
                        @if (Auth::check())
                            <a class="user-btn dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/creator/profile">Profile</a></li>
                                <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                            </ul>
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
        <p>&copy; 2024 V-Stream Creator. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
