<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>V-Stream</title>

  <!-- Zephyr Theme CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #121212;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #1f1f1f;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }

    .navbar {
      padding: 1rem 2rem;
    }

    .navbar-brand {
      font-size: 2rem;
      font-weight: 700;
      color: #00e676;
    }

    .navbar-nav .nav-link {
      color: #e0e0e0;
      font-size: 1rem;
      padding: 0.8rem 1rem;
      transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #00e676;
    }

    .user-btn {
      background-color: #00e676;
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
      background-color: #1f1f1f;
      color: #ccc;
      padding: 2rem 1rem;
      text-align: center;
      margin-top: auto;
    }

    footer a {
      color: #00e676;
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
        <a class="navbar-brand" href="/">V-Stream</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/liked">liked</a></li>
            {{-- <li class="nav-item"><a class="nav-link" href="/categories">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="/mylist">My List</a></li> --}}
          </ul>

          <!-- Search -->
          <form class="d-flex ms-3 me-3" action="/search" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search videos..." required>
            <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
          </form>

          <!-- User Menu -->
          <div class="dropdown">
            @if(Auth::check())
            <a class="user-btn dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/profile">Profile</a></li>
              <li><a class="dropdown-item" href="/watch-history">Watch History</a></li>
              <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
            </ul>
            @else
            <a class="btn btn-light ms-3" href="/login">Login</a>
            <a class="btn btn-success ms-2" href="/register">Sign Up</a>
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
