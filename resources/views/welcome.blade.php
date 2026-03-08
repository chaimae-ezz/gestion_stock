<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StockMaster - Gestion de Stock Professionnelle</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            position: relative;
            color: #fff;
        }

        /* Image de fond pleine page */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -2;
        }

        /* Overlay sombre pour meilleure lisibilité */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* Header transparent */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1.2rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #F37335, #FDC830);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
        }

        .logo-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .logo span {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            letter-spacing: 0.3px;
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
        }

        .btn-outline:hover {
            background: white;
            color: #333;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #F37335, #FDC830);
            color: white;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(243, 115, 53, 0.4);
        }

        .btn-large {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 120px 2rem 3rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            margin-bottom: 4rem;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: white;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        }

        .hero h1 span {
            background: linear-gradient(135deg, #F37335, #FDC830);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .hero p {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto 2.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 4rem;
            margin-top: 3rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Features Grid */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 3rem 0;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #F37335, #FDC830);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
        }

        .feature-icon i {
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: white;
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            margin: 3rem 0;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeInUp 1s ease 0.6s both;
        }

        .footer p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .footer span {
            color: #F37335;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-buttons {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<!-- Header avec boutons -->
<header class="header">
    <div class="header-content">
        <a href="/" class="logo">
            <div class="logo-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <span>StockMaster</span>
        </a>

        <nav class="nav-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </a>

                @endauth
            @endif
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    <!-- Hero Section -->
    <section class="hero">
        <h1>
            Gérez votre <span>stock</span>
        </h1>
        <p>
            Suivez vos produits, fournisseurs et mouvements avec une solution<br>
            complète, sécurisée et intuitive.
        </p>
    </section>

    <!-- Features Grid -->
    <section class="features">
        <!-- Produits -->
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-box"></i>
            </div>
            <h3>Gestion des produits</h3>
            <p>Catalogue complet avec références, prix, quantités et catégories. Interface intuitive et recherche avancée.</p>
        </div>

        <!-- Fournisseurs -->
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h3>Gestion des fournisseurs</h3>
            <p>Base de données complète avec historique des commandes, contacts et conditions d'achat.</p>
        </div>

        <!-- Mouvements -->
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <h3>Suivi des mouvements</h3>
            <p>Traçabilité complète des entrées, sorties et ajustements avec historique détaillé.</p>
        </div>

        <!-- Alertes -->
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-bell"></i>
            </div>
            <h3>Alertes automatiques</h3>
            <p>Notifications en temps réel pour les stocks bas et les produits à réapprovisionner.</p>
        </div>

        <!-- Statistiques -->
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Statistiques & rapports</h3>
            <p>Tableaux de bord interactifs et rapports personnalisables pour analyser vos données.</p>
        </div>

        <!-- Sécurité -->
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Sécurité & rôles</h3>
            <p>Gestion par rôles Admin/Employé avec permissions granulaires et protection des données.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>© {{ date('Y') }} StockMaster. Tous droits réservés. | <span>Ezzoubaa chaimae</span></p>
    </footer>
</main>
</body>
</html>
