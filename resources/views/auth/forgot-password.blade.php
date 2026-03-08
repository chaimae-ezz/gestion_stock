<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mot de passe oublié - StockMaster</title>

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
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* Container principal */
        .forgot-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            animation: fadeInUp 0.8s ease;
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

        /* Carte */
        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2.5rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* En-tête */
        .forgot-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #F37335, #FDC830);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
        }

        .logo-icon i {
            font-size: 2rem;
            color: white;
        }

        .logo span {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #F37335, #FDC830);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .forgot-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .forgot-header p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Message d'information */
        .info-message {
            background: rgba(243, 115, 53, 0.1);
            border: 1px solid #F37335;
            color: #F37335;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .info-message i {
            font-size: 1.2rem;
        }

        /* Session Status */
        .session-status {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #28a745;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .session-status i {
            font-size: 1.2rem;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-label i {
            color: #F37335;
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: white;
            color: #333;
        }

        .form-input:focus {
            outline: none;
            border-color: #F37335;
            box-shadow: 0 0 0 4px rgba(243, 115, 53, 0.1);
        }

        .form-input.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message i {
            font-size: 0.85rem;
        }

        /* Bouton */
        .btn-reset {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #F37335, #FDC830);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(243, 115, 53, 0.4);
        }

        .btn-reset:active {
            transform: translateY(0);
        }

        .btn-reset i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .btn-reset:hover i {
            transform: translateX(5px);
        }

        /* Lien retour */
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .back-link a {
            color: #F37335;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link a:hover {
            color: #FDC830;
        }

        .back-link a i {
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .forgot-container {
                padding: 1rem;
            }

            .forgot-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="forgot-container">
    <div class="forgot-card">
        <!-- En-tête -->
        <div class="forgot-header">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <span>StockMaster</span>
            </a>
            <h1>Mot de passe oublié ?</h1>
            <p>Réinitialisez votre mot de passe en toute sécurité</p>
        </div>

        <!-- Message d'information -->
        <div class="info-message">
            <i class="fas fa-info-circle"></i>
            <span>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</span>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i>
                    Adresse email
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="form-input @error('email') error @enderror"
                           placeholder="exemple@email.com">
                </div>
                @error('email')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Bouton -->
            <button type="submit" class="btn-reset">
                <span>Envoyer le lien de réinitialisation</span>
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>

        <!-- Lien retour -->
        <div class="back-link">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left"></i>
                Retour à la connexion
            </a>
        </div>
    </div>
</div>
</body>
</html>
