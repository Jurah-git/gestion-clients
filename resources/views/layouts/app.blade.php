<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Gestion des clients')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-bg: #14243a;
            --primary: #2563eb;
            --page-bg: #f4f7fb;
            --text-main: #1e293b;
        }

        body {
            background: var(--page-bg);
            color: var(--text-main);
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px 16px;
            z-index: 1000;
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 35px 8px;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary);
            color: white;
        }

        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e5eaf2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .page-content {
            padding: 30px;
        }

        .card {
            border: 1px solid #e8edf5;
            border-radius: 12px;
        }

        .shadow-sm {
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04) !important;
        }

        .btn {
            border-radius: 7px;
            padding: 8px 14px;
        }

        .form-control,
        .form-select {
            border-color: #dbe3ee;
            border-radius: 7px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .table th {
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 14px 12px;
        }

        .table td {
            padding: 14px 12px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 16px;
            }

            .brand {
                margin-bottom: 15px;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .topbar {
                height: 60px;
                padding: 0 16px;
            }

            .page-content {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <a href="{{ route('clients.index') }}" class="brand">
            <i class="bi bi-people-fill fs-3"></i>
            <span>Gestion des clients</span>
        </a>

        <nav class="nav flex-column">
            <a href="{{ route('clients.index') }}"
                class="nav-link {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Clients
            </a>

            <a href="{{ route('clients.create') }}"
                class="nav-link {{ request()->routeIs('clients.create') ? 'active' : '' }}">
                <i class="bi bi-person-plus-fill"></i>
                Ajouter un client
            </a>
        </nav>

        <hr class="border-secondary my-4">

        <div class="small text-secondary px-2">
            APPLICATION DE GESTION
        </div>
        <div class="small text-secondary px-2 mt-2">
            Version 1.0
        </div>
    </aside>

    <div class="main-wrapper">

        <header class="topbar">
            <div class="fw-semibold">
                @yield('page-heading', 'Espace de gestion')
            </div>

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle fs-4 text-primary"></i>
                <span class="text-secondary">Administrateur</span>
            </div>
        </header>

        <main class="page-content">
            @yield('content')
        </main>

        <footer class="text-center text-secondary small py-3">
            Gestion des clients &copy; {{ date('Y') }}
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
