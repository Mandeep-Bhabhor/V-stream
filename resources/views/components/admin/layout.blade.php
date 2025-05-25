<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Admin Dashboard | V-Stream</title>

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
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364, #1e1e1e);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    @keyframes gradientShift {
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
      background-color: #111;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
    }

    .navbar {
      padding: 1rem 2rem;
    }

    .navbar-brand {
      font-size: 1.9rem;
      font-weight: bold;
      color: #ffa726;
       font-family: 'Abolition', sans-serif;
      letter-spacing: 1px;
    }

    .navbar-nav .nav-link {
      color: #e0e0e0;
      padding: 0.7rem 1rem;
      font-size: 1rem;
      transition: color 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: #ffa726;
    }

    .admin-btn {
      background-color: #ffa726;
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
      color: #ffa726;
    }

    main {
      flex: 1;
      padding: 2rem;
      max-width: 1400px;
      width: 100%;
      margin: 2rem auto;
    }

    footer {
      background-color: #111;
      color: #ccc;
      padding: 1.5rem 1rem;
      text-align: center;
      margin-top: auto;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    footer a {
      color: #ffa726;
      text-decoration: none;
    }

    footer a:hover {
      color: #fff;
    }
    
     .diagonal-text {
            background: linear-gradient(30deg, white 0%, rgb(212, 172, 62) 70%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            /* increase as needed */
            font-weight: 700;
            font-family: 'Abolition', sans-serif;
            text-shadow: 0 0 6px rgba(153, 155, 78, 0.5);
            line-height: 1;
            /* prevents extra spacing */
            margin: 0;
            /* remove default margin */
        }
    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 1.5rem;
      }

      main {
        padding: 1rem;
      }

      .admin-btn {
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
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
  </style>
</head>

<body>

  <!-- Admin Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        {{-- <a class="navbar-brand" href="/admin/dashboard">Admin Panel</a> --}}
         <a class="navbar-brand diagonal-text" href="/admin/dashboard">V-Stream|Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/adminview/dashboard">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/videos">Videos</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/encode">Encode</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/audit">Audit</a></li>
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
    <p>&copy; 2024 <strong>V-Stream Admin</strong>. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
