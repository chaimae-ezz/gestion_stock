<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestion de Stock')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #06d6a0;
            --danger: #ef476f;
            --warning: #ffd166;
            --info: #118ab2;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --border: #dee2e6;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: var(--shadow);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow);
            margin-bottom: 25px;
            border: 1px solid var(--border);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--gray-light);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th {
            background: var(--gray-light);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid var(--border);
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
        }

        .table tr:hover {
            background: #f8f9fa;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-entree {
            background: #d4edda;
            color: #155724;
        }

        .badge-sortie {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-ajustement {
            background: #fff3cd;
            color: #856404;
        }

        .badge-inventaire {
            background: #d1ecf1;
            color: #0c5460;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            margin-top: 30px;
            gap: 5px;
        }

        .page-item {
            margin: 0;
        }

        .page-link {
            padding: 8px 16px;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .page-item.active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .page-link:hover {
            background: var(--gray-light);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }

            .card {
                padding: 20px;
            }

            .table {
                display: block;
                overflow-x: auto;
            }

            .navbar-menu {
                flex-direction: column;
                position: absolute;
                top: 70px;
                right: 20px;
                background: white;
                padding: 20px;
                border-radius: 12px;
                box-shadow: var(--shadow-lg);
                display: none;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <i class="fas fa-boxes"></i>
            StockMaster
        </a>

        <!-- Menu de navigation - Liens simples sans style de bouton -->
        <div class="navbar-menu">
            <a href="{{ route('produits.index') }}" style="color: white; text-decoration: none; margin: 0 15px;">
                Produits
            </a>
            <a href="{{ route('mouvements.index') }}" style="color: white; text-decoration: none; margin: 0 15px;">
                Mouvements
            </a>
            <a href="{{ route('fournisseurs.index') }}" style="color: white; text-decoration: none; margin: 0 15px;">
                Fournisseurs
            </a>
            <a href="{{ route('statistique') }}" style="color: white; text-decoration: none; margin: 0 15px;">
                Statistiques
            </a>
        </div>

        <!-- User Menu -->
        <div class="user-menu">
            <span style="color: white; margin-right: 10px;">{{ Auth::user()->name }}</span>
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>

<script>
    // Messages flash auto-dismiss
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
</body>
</html>
