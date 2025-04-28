<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Admin Dashboard | V-Stream</title>

  <!-- Zephyr Theme CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #0e0e0e;
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
      background-color: #212121;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    }

    .navbar {
      padding: 1rem 2rem;
    }

    .navbar-brand {
      font-size: 1.8rem;
      font-weight: bold;
      color: #ff6f00;
    }

    .navbar-nav .nav-link {
      color: #e0e0e0;
      padding: 0.7rem 1rem;
      font-size: 1rem;
    }

    .navbar-nav .nav-link:hover {
      color: #ff6f00;
    }

    .admin-btn {
      background-color: #ff6f00;
      color: #121212;
      border-radius: 20px;
      padding: 0.5rem 1rem;
      font-weight: 500;
    }

    .dropdown-menu {
      background-color: #2b2b2b;
      border: none;
    }

    .dropdown-item {
      color: #e0e0e0;
    }

    .dropdown-item:hover {
      background-color: #333;
      color: #ff6f00;
    }

    main {
      flex: 1;
      padding: 2rem;
      max-width: 1400px;
      width: 100%;
      margin: 2rem auto;
    }

    footer {
      background-color: #212121;
      color: #aaa;
      padding: 2rem 1rem;
      text-align: center;
      margin-top: auto;
    }

    footer a {
      color: #ff6f00;
      text-decoration: none;
    }

    footer a:hover {
      color: #fff;
    }

    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 1.4rem;
      }

      main {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>

  <!-- Admin Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/admin/dashboard">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/adminview/dashboard">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/users">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/videos">Videos</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/encode">Encode</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/categories">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/reports">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/settings">Settings</a></li>
          </ul>

          <div class="dropdown ms-3">
            @if(Auth::check())
            <a class="admin-btn dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-badge"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/admin/profile">Profile</a></li>
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
    <p>&copy; 2024 V-Stream Admin. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
